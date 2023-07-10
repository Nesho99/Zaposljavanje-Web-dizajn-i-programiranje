<?php
class QueryBuilder {
    protected $query;
    protected $values;

    public function select($fields) {
        $this->query = 'SELECT ' . (is_array($fields) ? implode(', ', $fields) : $fields);
        return $this;
    }

    public function insertInto($table, $columns) {
        $this->query = 'INSERT INTO ' . $table . ' (' . implode(', ', $columns) . ')';
        return $this;
    }

    public function values($values) {
        $this->values = ' VALUES (' . implode(', ', array_map(function($v) { return "'$v'"; }, $values)) . ')';
        return $this;
    }

    public function deleteFrom($table) {
        $this->query = 'DELETE FROM ' . $table;
        return $this;
    }

    public function update($table) {
        $this->query = 'UPDATE ' . $table;
        return $this;
    }

    public function set($values) {
        $set = [];
        foreach($values as $key => $value) {
            $set[] = "$key = '$value'";
        }
        $this->query .= ' SET ' . implode(', ', $set);
        return $this;
    }

    public function from($table) {
        $this->query .= ' FROM ' . $table;
        return $this;
    }

    public function where($conditions) {
        $this->query .= ' WHERE ' . (is_array($conditions) ? implode(' AND ', $conditions) : $conditions);
        return $this;
    }
    public function join($table, $conditions, $type = 'INNER') {
        $this->query .= ' ' . strtoupper($type) . ' JOIN ' . $table . ' ON ' . $conditions;
        return $this;
    }

    public function like($field, $value) {
        $this->query .= (strpos($this->query, 'WHERE') !== false ? ' AND ' : ' WHERE ') . "$field LIKE '%$value%'";
        return $this;
    }

    public function orderBy($fields, $direction = 'ASC') {
        if (is_array($fields)) {
            $orderByFields = implode(', ', $fields);
            $this->query .= ' ORDER BY ' . $orderByFields . ' ' . strtoupper($direction);
        } else {
            $this->query .= ' ORDER BY ' . $fields . ' ' . strtoupper($direction);
        }
        return $this;
    }
    

    public function limit($number) {
        $this->query .= ' LIMIT ' . $number;
        return $this;
    }

    public function offset($number) {
        $this->query .= ' OFFSET ' . $number;
        return $this;
    }

    public function groupBy($field) {
        $this->query .= ' GROUP BY ' . $field;
        return $this;
    }

    public function having($condition) {
        $this->query .= ' HAVING ' . $condition;
        return $this;
    }

    public function getQuery() {
        if ($this->values) {
            return $this->query . $this->values . ';';
        }
        return $this->query . ';';
    }
    
}
/*
Korištenje

$queryBuilder = new QueryBuilder();

// SELECT query with LIKE
$selectQuery = $queryBuilder->select(['name', 'email'])
    ->from('users')
    ->like('name', 'John')
    ->orderBy('name', 'desc')
    ->limit(10)
    ->offset(20)
    ->getQuery();
echo $selectQuery;  // Outputs: SELECT name, email FROM users WHERE name LIKE '%John%' ORDER BY name DESC LIMIT 10 OFFSET 20;

// INSERT query
$queryBuilder = new QueryBuilder();  // New instance to start fresh
$insertQuery = $queryBuilder->insertInto('users', ['name', 'email'])
    ->values(['John', 'john@example.com'])
    ->getQuery();
echo $insertQuery;  // Outputs: INSERT INTO users (name, email) VALUES ('John', 'john@example.com');

// UPDATE query
$queryBuilder = new QueryBuilder();  // New instance to start fresh
$updateQuery = $queryBuilder->update('users')
    ->set(['name' => 'John Doe', 'email' => 'john.doe@example.com'])
    ->where('id = 1')
    ->getQuery();
echo $updateQuery;  // Outputs: UPDATE users SET name = 'John Doe', email = 'john.doe@example.com' WHERE id = 1;

// DELETE query
$queryBuilder = new QueryBuilder();  // New instance to start fresh
$deleteQuery = $queryBuilder->deleteFrom('users')
    ->where('id = 1')
    ->getQuery();
echo $deleteQuery;  // Outputs: DELETE FROM users WHERE id = 1;


$queryBuilder = new QueryBuilder();

$selectQuery = $queryBuilder->select(['users.name', 'orders.order_number'])
    ->from('users')
    ->join('orders', 'users.id = orders.user_id', 'INNER')
    ->where('users.id = 1')
    ->getQuery();

echo $selectQuery;
// Outputs: SELECT users.name, orders.order_number FROM users INNER JOIN orders ON users.id = orders.user_id WHERE users.id = 1;


*/
?>