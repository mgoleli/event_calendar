<?php


class event extends Controller
{

    public function index()
    {
        // load view
        require APP . 'view/event/event.php';
    }
    
    public function load() {
        //get events
    	$evs = $this->model->getEvents();
    	echo json_encode($evs);
    }
    
    public function insert() {
        //insert event
    	if(isset($_POST["title"]))
    	{
    		$this->model->addEvent($_POST['title'], $_POST['start'], $_POST['end']);
    	}
    }
    
    public function delete() {
        //delete event
    	if(isset($_POST["id"]))
    	{
    		$this->model->deleteEvent($_POST["id"]);
    	}
    }
    
    public function update() {
        //update event
    	if(isset($_POST["id"])){
    		$this->model->updateEvent($_POST["id"], $_POST["title"], $_POST["start"], $_POST["end"]);	
    	}
    }

}
