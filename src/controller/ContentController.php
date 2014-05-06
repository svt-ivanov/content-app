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
    private $data = array(
        'default_content' => 'Italian sculptors and painters of the renaissance favored the Virgin Mary for inspiration.'
    );


    public function connect(Application $app)
    {
        $contentController = $app['controllers_factory'];
        $contentController->get('/', array($this, 'index'))->bind('home');
        $contentController->post('/analyze', array($this, 'analyze'));

        return $contentController;
    }

    /**
     * @param Silex\Application $app
     * @return Symfony\Component\HttpFoundation\Response object
     */
    public function index(Application $app)
    {
        return new Response(View::render('home', $this->data), 200);
    }

    /**
     * @param Symfony\Component\HttpFoundation\Request $request
     * @param Silex\Application $app
     * @return Symfony\Component\HttpFoundation\Response object
     */
    public function analyze(Request $request, Application $app)
    {
        if ($request->isMethod('POST')) {
            $this->data['content'] = $request->request->get("content");

            $content_model = new Content($this->data);
            $this->data['analysis'] = $content_model->getTerms();
        }

        return new Response(View::render('home', $this->data), 201);
    }
}