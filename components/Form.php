<?php

namespace Novelus\Forms\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Novelus\Forms\Models\Field;
use Novelus\Forms\Models\Form as FormModel;
use Novelus\Forms\Models\Settings;
use Novelus\Forms\Models\Submission;
use October\Rain\Exception\AjaxException;
use October\Rain\Exception\ValidationException;
use October\Rain\Support\Facades\Flash;

class Form extends ComponentBase
{
    public $fields;

    public $form;

    public $siteKey;

    /**
     * Form submit handler
     *
     * @return void
     * @throws ValidationException
     */
    public function onNovelusFormSubmit()
    {
        // CSRF Check
        if (Session::token() != post('_token')) {
            //            throw new AjaxException(['#' . $this->alias . '_forms_flash' => $this->renderPartial($flash_partial, [
            //                'status'  => 'error',
            //                'type'    => 'danger',
            //                'content' => Lang::get('martin.forms::lang.components.shared.csrf_error'),
            //            ])]);

            // TODO: Handle token error
        }

        // validate recaptcha

        $form = FormModel::findOrFail(post('form'));

        if ($form->has_recaptcha) {
            $recaptcha = post('g-recaptcha-response');
            $ip = Request::getClientIp();
            $secretKey = Settings::get('recaptcha_secret_key');
            $url = "https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptcha}&remoteip={$ip}";
            $response = json_decode(file_get_contents($url), true);

            if ($response['success'] !== true) {
                throw new ValidationException(['recaptcha' => 'Bot validation failed']);
            }
        }

        // do a validation

        $fields = request()->except(['_session_key', '_token', 'g-recaptcha-response']);

        $validations = $this->prepareValidationRules($form);
        $validator = Validator::make($fields, $validations);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // TODO: Fire the event beforeSave

        $submission = new Submission;
        $submission->value = json_encode($fields, JSON_UNESCAPED_UNICODE);
        $submission->save();

        // TODO: Fire the event afterSave

        // Send email if form email notifications are enabled
        if ($form->has_email_notifications_enabled) {
            $sendTo = $this->prepareRecipients($form->send_notification_to);
            Mail::sendTo($sendTo, 'novelus.forms::mail.notification', $submission->toArray());
        }

        Flash::success('Thank you for your message!');
    }

    private function prepareRecipients(array $recipients)
    {
        $prepared = [];

        foreach ($recipients as $recipient) {
            $prepared = array_merge($prepared, [$recipient['email'] => $recipient['name']]);
        }

        return $prepared;
    }

    private function prepareValidationRules(FormModel $form)
    {
        $rules = []; // [ 'name' => 'string|required']
        $fields = $form->fields;

        foreach ($fields as $field) {
            $rules = array_merge($rules, [$field->name => $this->getValidationRulesForField($field)]);
        }

        return $rules;
    }

    private function getValidationRulesForField(Field $field)
    {
        $rules = '';

        if ($field->is_required) $rules .= 'required';

        return $rules;
    }

    public function onRun()
    {
        $this->addJs('/plugins/novelus/forms/assets/js/novelus-forms.js');

        $formId = $this->property('formId');
        $form = $this->form = FormModel::with('fields')->findOrFail($formId);

        if ($form->has_recaptcha) {
            $this->addJs('https://www.google.com/recaptcha/api.js', ['async', 'defer']);
            $this->siteKey = Settings::get('recaptcha_site_key');
        }

        $this->fields = $form->fields()->orderBy('order', 'asc')->get();
    }

    public function defineProperties()
    {
        return [
            'formId' => [
                'title' => 'Form ID',
                'description' => 'Enter the form ID to display',
                'type' => 'string',
                'required' => true
            ]
        ];
    }

    public function componentDetails()
    {
        return [
            'name' => 'Form',
            'description' => 'Displays a selected form.'
        ];
    }
}
