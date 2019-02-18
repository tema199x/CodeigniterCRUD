<?php

defined('BASEPATH') OR exit('Now direct script access allowed');

class News extends CI_Controller {  //наследование от главного контроллера

    public function __construct() { //создаем конструктор для последующей инициализации компонентов 

        parent::__construct(); //обращаемся к родительскому классу кодегнитер

        $this->load->model('news_model'); //обращение к модели

    }

    public function index() {  //наполняем нашу страцницу индекс данными 

        $data['title'] = "Все новости"; //заносим в переменную название страницы (переменная)

        $data['news'] = $this->news_model->getNews();//обращение в контроллере к модели ? массив данных news (переменная)

        $this->load->view('templates/header', $data); //первым подгружаем наш хеадер из view вида и подгрузка названия страницы через передачу $data

        $this->load->view('news/index', $data);  //далее index с h1 как контент между footer и header

        $this->load->view('templates/footer'); //и в конце footer 
    }

    public function view($slug = NULL) {

        $data['news_item'] = $this->news_model->getNews($slug); //обращение в контроллере к модели,передаем $slug (переменная)
        //если он указан(по условию в модели), он у нас указан в routes с помощью $1
        if(empty($data['news_item'])) { // если слага нету, то

            show_404(); //стандартная ошибка фраймворка codeigniter

        } 

        $data['title'] = $data['news_item']['title']; //заносим в переменную название страницы из бд (переменная) 

        $data['content'] = $data['news_item']['text']; //заносим в переменную текст из бд

        $this->load->view('templates/header', $data); //первым подгружаем наш хеадер из view вида и передаем $data

        $this->load->view('news/view', $data);  //далее index с h1 как контент между footer и header

        $this->load->view('templates/footer'); //и в конце footer 
    }

    public function create() {

        $data['title'] = "Дабавление данных";

        //$this->input->post('slug');//получение данных формы create поля input с именем slug
        //проверка, если есть данные из формы
        if($this->input->post('slug') && $this->input->post('title') && $this->input->post('text')) {
            //можно сделать еще проверку на поступающие данные от пользователя
            $slug = $this->input->post('slug');
            $title = $this->input->post('title');
            $text = $this->input->post('text');

            //если данные успешно подгрузятся в модель news_model то
            if($this->news_model->setNews($slug, $title, $text)) {
                $this->load->view('templates/header', $data);
                $this->load->view('news/success', $data);
                $this->load->view('templates/footer');
            } 
        
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('news/create', $data);
            $this->load->view('templates/footer');
        }
    }

	public function edit($slug = NULL) {
		$data['title'] = "редактировать новость";
		$data['news_item'] = $this->news_model->getNews($slug);


		$data['title_news'] = $data['news_item']['title'];
		$data['content_news'] = $data['news_item']['text'];
		$data['slug_news'] = $data['news_item']['slug'];

		if($this->input->post('slug') && $this->input->post('title') && $this->input->post('text')) {
			$slug = $this->input->post('slug');
			$title = $this->input->post('title');
			$text = $this->input->post('text');

			if($this->news_model->updateNews($slug, $title, $text)) {
				echo "Новость успешно отредактирована";
			}
		} else {

		$this->load->view('templates/header', $data);
		$this->load->view('news/edit', $data);
        $this->load->view('templates/footer');
        }
        
    }
    
    public function delete($slug = NULL) {
		$data['news'] = $this->news_model->getNews($slug);

		if(empty($data['news'])) {
			show_404();
		}

		$data['title'] = "удалить новость";
		$data['result'] = "Ошибка удаления ".$data['news']['title'];

		if($this->news_model->deleteNews($slug)) {
			$data['result'] = $data['news']['title']." успешно удалена";
		}

		$this->load->view('templates/header', $data);
		$this->load->view('news/delete', $data);
		$this->load->view('templates/footer');

	}

}