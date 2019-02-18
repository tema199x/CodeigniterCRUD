<?php 

class News_model extends CI_Model { //наследование от главной модели 

    public function __construct() {

        $this->load->database(); //загрузка базы данных

    }
    //получение новости из базы данных
    public function getNews($slug = FALSE) {  //слага не существует переходим ниже

        if($slug === FALSE) {  //если слага не существует выпоняются действия ниже, тоесть возвращает все новости

            $query = $this->db->get('news'); //запрос в базу 

            return $query->result_array();  //вернет все значения из таблички news

        }
        //если же слуг существует, то выполняется все ниже
        $query = $this->db->get_where('news', array('slug' => $slug));

        return $query->row_array();
    }

    public function setNews($slug, $title, $text) {
        $data = array(
            'slug' => $slug,
            'title' =>$title,
            'text' => $text
        );

        return $this->db->insert('news', $data); //запрос на добавление данных в бд таблицу
    }

	public function updateNews($slug, $title, $text) {

		$data = array(
			'title' => $title,
			'slug' => $slug, 
			'text' => $text
		);

		return $this->db->update('news', $data, array('slug' => $slug));

    }
    
    public function deleteNews($slug) {
        return $this->db->delete('news', array('slug' => $slug)); 
    }

}