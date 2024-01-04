<?php

trait Model
{
    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "DESC";
    protected $order_column = "id";

    // used to get all the rows from a table without any specified condition 
    public function getAll()
    {
        $query = "SELECT * FROM $this->table ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        return $this->query($query);
    }

    // used to get all the rows from a table where a specific condition has to be verified
    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }
        // remove the last " && "
        $query = substr_replace($query, "", -strlen(" && "));

        if ($data_not) {
            $query .= " && ";
            foreach ($keys_not as $key_not) {
                $query .= $key_not . " != :" . $key_not . " && ";
            }
            $query = substr_replace($query, "", -strlen(" && "));
        }
        // for pagination
        $query .= " LIMIT $this->limit OFFSET $this->offset";
        $data = array_merge($data, $data_not);
        return $this->query($query, $data);
    }

    // used to get the first row from a table where a specific condition has to be verified, if the later is not verified it returns "false"
    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }
        $query = substr_replace($query, "", -strlen(" && "));
        if ($data_not) {
            $query .= " && ";
            foreach ($keys_not as $key_not) {
                $query .= $key_not . " != :" . $key_not . " && ";
            }
            $query = substr_replace($query, "", -strlen(" && "));
        }
        $query .= " LIMIT $this->limit OFFSET $this->offset";
        $data = array_merge($data, $data_not);
        $result = $this->query($query, $data);
        if ($result) return $result[0];
        return false;
    }


    public function insert($data)
    {
        $keys = array_keys($data);
        // remove unallowed data (columns)
        // if (!empty($this->allowedColumns)) {
        //     foreach ($keys as $key) {
        //         if (!in_array($key, $this->allowedColumns)) {
        //             unset($data[$key]);
        //         }
        //     }
        // }
        $columns = "";
        $values = "";
        foreach ($keys as $key) {
            $columns .= $key . ",";
            $values .= ":" . $key . ",";
        }
        $columns = substr_replace($columns, "", -1);
        $values = substr_replace($values, "", -1);
        $query = "INSERT INTO $this->table ($columns) VALUES($values)";
        $this->query($query, $data);
        return false;
    }

    public function update($id, $data, $table_id = 'id')
    {
        $keys = array_keys($data);
        // remove unallowed data (columns)
        // if (!empty($this->allowedColumns)) {
        //     foreach ($keys as $key) {
        //         if (in_array($key, $this->allowedColumns)) {
        //             unset($data[$key]);
        //         }
        //     }
        // }
        $query = "UPDATE $this->table SET ";

        foreach ($keys as $key) {
            $query .= "$key = :$key,";
        }

        $query .= " WHERE $table_id = :$table_id";
        $data[$table_id] = $id;

        $this->query($query, $data);
        return false;
    }
    public function delete($id, $column_id = 'id')
    {
        $query = "DELETE FROM $this->table WHERE $column_id = :$column_id";
        $data[$column_id] = $id;
        $this->query($query, $data);
        return false;
    }
}
