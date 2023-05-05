<?php
//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
?>

<?php
class Database
{
    // Update the following with your database credentials
    public $dsn = "mysql:host=us-cdbr-east-06.cleardb.net;dbname=heroku_dfdc5cf28c06aa6";
    public $username = "bedb62f2f3a0f9";
    public $password = "222e3331";
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->username, $this->password);
            // echo "Successfully Connected!";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function read()
    {
        $data = array();
        $sql = "SELECT id, name, email, school, major, year, resume FROM approvedstudent order by id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getUserBiId($id)
    { 
        $sql = "SELECT id, name, email, school, major, year, resume FROM approvedstudent WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function delete($id)
    {
        $sql1 = "DELETE FROM approvedstudent WHERE id=:id";
        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->execute(['id' => $id]);
        return true;
    }

    public function totalRowCount()
    {
        $sql = "SELECT count(*)  FROM approvedstudent";
        $result = $this->conn->prepare($sql);
        $result->execute();
        $number_of_rows = $result->fetchColumn();
        return $number_of_rows;
    }
}

$ob = new Database();
