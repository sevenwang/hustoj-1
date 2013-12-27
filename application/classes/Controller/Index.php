<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_My
{

    public function action_index()
    {
        $this->view->title = 'Home';

        $cache = Cache::instance();
        $rss = $cache->get('bitbucket-rss', null);
        if ($rss === null) {
            //$data = file_get_contents('https://bitbucket.org/freefcw/hustoj/rss');
            //$rss = Feed::parse($data);
            $rss = array(
                array('title' => '1000', 'link' => '/problem/show/1000'),
                array('title' => '1001', 'link' => '/problem/show/1001')
            );
            $cache->set('bitbucket-rss', $rss, 300);
        }
        $body = View::factory('index');
        $body->rss = $rss;

        $this->view->body = $body;

    }

    public function action_home()
    {
        $this->action_index();
    }

    public function action_install()
    {
        $db = MDB::getInstance();
        $counters = $db->db->selectCollection('counterss');
        $item = $counters->findOne();
        if ($item) {
            $this->request->redirect('/');
        } else {
            $item = array(
                'topic_id'   => 1,
                'reply_id'   => 1,
                'problem_id' => 1000,
                'contest_id' => 1000,
            );
            $counters->save($item);
        }

    }

    public function action_faqs()
    {
        $this->view->title = 'FAQS';

        $body = View::factory('index/faqs');
        $this->view->body = $body;
    }

    public function action_status()
    {
        //TODO: add visible
        //TODO: 1. add total problems
        //TODO: 2. add total users
        //TODO: 3. add total submission status, total, tle, ac, re, etc.
        //TODO: 4. server status, system load, network...
        //TODO:
        $this->view->title = "HUST OJ STATUS";

        $body = View::factory('index/status');
        $this->view->body = $body;
    }

    public function action_about()
    {

        $this->view->title = "About HUST OJ";

        $body = View::factory('index/about');
        $this->view->body = $body;
    }

    public function action_links()
    {

        $this->view->title = "Friends Link";

        $body = View::factory('index/links');
        $this->view->body = $body;
    }

    public function action_contact()
    {

        $this->view->title = "Contact US";

        $body = View::factory('index/contact');
        $this->view->body = $body;
    }

    public function action_help()
    {
        $this->view->title = 'FAQS';

        $body = View::factory('index/help');
        $this->view->body = $body;
    }

    public function action_terms()
    {
        $this->view->title = 'TERMS';

        $body = View::factory('index/help');
        $this->view->body = $body;
    }

} // End Index