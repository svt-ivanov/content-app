<?php
namespace controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use Silex\ControllerProviderInterface;

use library\View;
use model\Content;

class ContentController implements ControllerProviderInterface
{
    /**
     * A default content to search for.
     * 
     * @var array
     */
    private $data = array(
        'default_content' => 'Italian sculptors and painters of the renaissance favored the Virgin Mary for inspiration.'
    );


    /**
     * Set up controller methods.
     * 
     * @param  Application $app
     * @return Object
     */
    public function connect(Application $app)
    {
        $contentController = $app['controllers_factory'];
        $contentController->get('/', array($this, 'index'))->bind('home');
        $contentController->post('/analyze', array($this, 'analyze'));

        return $contentController;
    }


    /**
     * Index method.
     * 
     * @param Silex\Application $app
     * @return Symfony\Component\HttpFoundation\Response object
     */
    public function index(Application $app)
    {
        return new Response(View::render('home', $this->data), 200);
    }


    /**
     * Responsible for serving content got from Yahoo API to
     * the Ajax service.
     * 
     * @param Symfony\Component\HttpFoundation\Request $request
     * @param Silex\Application $app
     * @return Symfony\Component\HttpFoundation\Response object
     */
    public function analyze(Request $request, Application $app)
    {
        if ($this->isAjax()) {
            $this->data['content'] = $request->request->get("content");

            // get ready-to-use format data from the API
            $content_model = new Content($this->data);
            $this->data['analysis'] = $content_model->getTerms();

            // send partial view 'terms' to the Ajax service
            return View::render('terms', $this->data);
        }

        return new Response(View::render('home', $this->data), 200);
    }


    /**
     * Detect Ajax request.
     * 
     * @return boolean
     */
    private function isAjax()
    {
        return ( ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ? true : false);
    }
}