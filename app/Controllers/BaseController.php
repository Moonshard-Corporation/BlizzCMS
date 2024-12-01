<?php

namespace App\Controllers;

use App\Libraries\Multilanguage;
use App\Libraries\Template;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['url', 'text'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Multilanguage library
     * 
     * @var \Libraries\Multilanguage
     */
    protected $multilanguage;

    /**
     * Template library
     * 
     * @var Template
     */
    protected $template;

    /**
     * The current language
     * 
     * @var string
     */
    protected $currentLanguage;

    /**
     * View data
     * 
     * @var array
     */
    protected $viewData = [];

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->loadCustomHelpers();
        $this->loadMultilanguage();
        $this->loadTemplate();

        $language = \Config\Services::language();
        $language->setLocale($this->currentLanguage);
    }

    private function loadMultilanguage()
    {
        $this->multilanguage = new Multilanguage();

        $this->currentLanguage = $this->multilanguage->currentLanguage('locale');
    }

    private function loadTemplate()
    {
        $configOfTemplate = config(\Config\Template::class);

        $this->template = new Template([
            'parserEnabled' => $configOfTemplate->parserEnabled,
            'parserBodyEnabled' => $configOfTemplate->parserBodyEnabled,
            'titleSeparator' => $configOfTemplate->titleSeparator,
            'layout' => $configOfTemplate->layoutName,
            'theme' => $configOfTemplate->theme,
            'themeLocations' => $configOfTemplate->themeLocations
        ]);
        $this->template->set('multilanguage', $this->multilanguage);
    }

    private function loadCustomHelpers()
    {
        helper(['common', 'extra']);
    }
}
