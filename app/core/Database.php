<?php

trait Database
{
    private function connect()
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=tdw', 'root');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $db;
        } catch (PDOException $e) {
            print "couldn't connect to database : " . $e->getMessage();
        }
    }

    public function query($query, $data = [])
    {
        $db = $this->connect();
        $stmt = $db->prepare($query);
        $success = $stmt->execute($data);
        if ($success) {
            $result = $stmt->fetchAll();
            if (count($result)) {
                $stmt = null;
                $db = null;
                return $result;
            }
        }
        $stmt = null;
        $db = null;
        return [];
    }
}
