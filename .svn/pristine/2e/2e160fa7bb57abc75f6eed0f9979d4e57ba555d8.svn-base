<?php

class Model extends Database {

    public $id;

    public function __construct($id = null) {
        parent::__construct();
        if ($id) {
            return $this->find($id);
        }
    }

    public function findAllBySql($sql) {
        $query = $this->_db->query($sql);
        if ($query) {
            if ($query->num_rows) {
                $modelName = get_called_class();
                $collection = array();
                while ($result = $query->fetch_assoc()) {
                    $model = new $modelName();
                    $model->setProperties($result);
                    $collection[$model->id] = $model;
                }
                return $collection;
            }
        }
        return false;
    }

    public function findBySql($sql) {
        $query = $this->_db->query($sql);
        if ($query) {
            if ($query->num_rows) {
                $this->setProperties($query->fetch_assoc());
                return true;
            }
        }
        return false;
    }

    public function find($options = array()) {
        if (!is_array($options)) {
            $id = $options;
            $options = array();
            $options['conditions'] = array(
                'id' => $id
            );
        }
        $conditions = array();
        foreach ($options['conditions'] as $field => $value) {
            $conditions[] = '`' . array_search($field, $this->_fields) . '` = "' . $value . '"';
        }

        $sql = 'SELECT * FROM `' . $this->_table . '` WHERE ' . implode(' && ', $conditions);
        return $this->findBySql($sql);
    }

    public function findAll($options = array()) {
        $conditions = array();
        if (isset($options['conditions'])) {
            foreach ($options['conditions'] as $field => $value) {
                $conditions[] = '`' . array_search($field, $this->_fields) . '` = "' . $value . '"';
            }
        }

        $sql = 'SELECT * FROM `' . $this->_table . '` WHERE ' . implode(' && ', $conditions);
        return $this->findAllBySql($sql);
    }

    protected function setProperties($properties) {
        foreach ($properties as $databaseName => $value) {
            $modelName = $this->_fields[$databaseName];
            $this->$modelName = $value;
        }
    }

    public function create() {
        $sql = 'INSERT INTO `' . $this->_table . '`';

        if (isset($this->_fields['created'])) {
            $this->created = date(TIMESTAMP_FORMAT);
            $sql .= ' SET `created` = "' . $this->created . '"';
        }
        else {
            $sql .= ' VALUES()';            
        }
        
        if ($this->_db->query($sql)) {
            $this->id = $this->_db->insert_id;
        }
        return false;
    }

    public function delete() {
        if ($this->id && $this->_db->query('DELETE FROM `' . $this->_table . '` WHERE `id` = ' . $this->id)) {
            return true;
        }
        return false;
    }

    public function update() {
        $fields = array();

        if (isset($this->_fields['modified'])) {
            $this->modified = date(TIMESTAMP_FORMAT);
        }
        foreach ($this->_fields as $databaseName => $fieldName) {
            $fields[] = '`' . $databaseName . '` = "' . $this->$fieldName . '"';
        }

        if ($this->_db->query('UPDATE `' . $this->_table . '` SET ' . implode(', ', $fields) . ' WHERE `id` = ' . $this->id)) {
            return true;
        }
        return false;
    }

}