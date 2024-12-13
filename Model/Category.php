<?php
class Category
{
    protected $dbHandle, $dbInstance;
    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getDbConnection();
    }

    public function categoryAssign()
    {
        // Query to fetch all skills
        $query = 'SELECT * FROM "Category"';
        $stmt = $this->dbHandle->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Create the associative array
        $categories = [];
        foreach ($result as $row)
        {
            $categories[$row['UniqueID']] = $row['categoryName'];
        }
        //var_dump($categories);
        return $categories;

    }
}