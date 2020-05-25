<?php namespace Novelus\Forms\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Novelus\Forms\Models\Submission;

class Submissions extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\ReorderController'    ];

    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Novelus.Forms', 'main-menu-item', 'side-menu-item2');
    }

    public function view($id)
    {
        $submission = Submission::findOrFail($id);
        $this->pageTitle = 'testttt';
        $this->vars['submission'] = $submission;
    }
}
