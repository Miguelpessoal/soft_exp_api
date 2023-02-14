<?php
    
test('it should be able to store a product_type', function () {
    $db = new PDO('sqlite::memory:');
    $db->exec("CREATE TABLE product_types (id INTEGER PRIMARY KEY, label TEXT, tax_value FLOAT)");
            
    $query = $db->prepare("INSERT INTO product_types (label, tax_value) VALUES (:label, :tax_value)");
    $query->execute(['label' => 'Manufaturados', 'tax_value' => 11.50]);
    
    
    $query = $db->query("SELECT * FROM product_types");
    $response = $query->fetchAll();
    
    expect($response)->not()->toBeEmpty();
});

test('it should be able to update a product_type', function () {
    $db = new PDO('sqlite::memory:');
    $db->exec("CREATE TABLE product_types (id INTEGER PRIMARY KEY, label TEXT, tax_value FLOAT)");

    $query = $db->prepare("INSERT INTO product_types (label, tax_value) VALUES (:label, :tax_value)");
    $query->execute(['label' => 'Manufaturados', 'tax_value' => 11.50]);
    
    $query = $db->prepare("UPDATE product_types SET label = 'Veganos' WHERE id = 1");
    $query->execute();
    
    $request = $db->prepare("SELECT * FROM product_types ORDER BY id");
    $request->execute();
    
    $data = $request->fetchAll(PDO::FETCH_ASSOC);
    var_dump($data[0]['label']);
    
    $this->assertEquals('Veganos', $data[0]['label']);
});

test('it should be able to delete a product-type', function () {
    $db = new PDO('sqlite::memory:');
    $db->exec("CREATE TABLE product_types (id INTEGER PRIMARY KEY, label TEXT, tax_value FLOAT)");

    $query = $db->prepare("INSERT INTO product_types (label, tax_value) VALUES (:label, :tax_value)");
    $query->execute(['label' => 'Manufaturados', 'tax_value' => 11.50]);
    
    
    $query = $db->query("SELECT * FROM product_types");
    $response = $query->fetchAll();

    $param = $response[0]['id'];
    
    $query = $db->prepare("DELETE FROM product_types WHERE id = :id");
    $query->bindParam(':id', $param);
    $query->execute();

    $query = $db->query("SELECT * FROM product_types WHERE id = :id");
    $query->bindParam(':id', $param);
    $assert = $query->fetchAll();
    
    expect($assert)->toBeEmpty();
});