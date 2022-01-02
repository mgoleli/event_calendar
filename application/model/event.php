<?php

class Model
{
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getEvents()
    {
        $sql = "SELECT * FROM events ORDER BY id";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function addEvent($title, $start, $end)
    {
        $sql = "INSERT INTO events 
				 (title, start, end) 
				 VALUES (:title, :start, :end)";
        $query = $this->db->prepare($sql);
        $parameters = array(
        	':title'  => $title,
        	':start' => $start,
        	':end' => $end
		);

        return $query->execute($parameters);
    }

    public function deleteEvent($id)
    {
        $sql = "DELETE from events WHERE id=:id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        return $query->execute($parameters);
    }

    public function updateEvent($id, $title, $start, $end)
    {
        $sql = "UPDATE events 
				SET title=:title, start=:start, end=:end 
				WHERE id=:id";
        $query = $this->db->prepare($sql);
        $parameters = array(
        		':id'   => $id,
        		':title'  => $title,
        		':start' => $start,
        		':end' => $end
        );

        $query->execute($parameters);
    }

}
