<?php

class Model
{
    use Database;
    protected $table = 'user';
    protected $limit = 10;
    protected $offset = 0;

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

    public function update($new_values, $data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "UPDATE $this->table SET ";

        foreach ($new_values as $column => $value) {
            $query .= "$column = :$column,";
        }
        $query = substr_replace($query, "", -1);
        $query .= " WHERE ";
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }
        // remove the last " && "
        $query = substr_replace($query, "", -strlen(" && "));

        if ($data_not) {
            foreach ($keys_not as $key_not) {
                $query .= $key_not . " != :" . $key_not . " && ";
            }
            $query = substr_replace($query, "", -strlen(" && "));
        }
        $data = array_merge($data, $data_not, $new_values);
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
