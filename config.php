<?php 
Class Model{
    private $server = "localhost";
    private $username = "root";
    private $password = "software";
    private $db = "refresher";
    private $conn;

    public function __construct(){
        try{
            $this->conn = new mysqli($this->server,$this->username, $this->password, $this->db);
        }catch(Exception $e){
            echo "Connection failed".$e->getMessage();
        }
    }
    // protected function __firebasePusher(){
    //     return null;
    // }
      // Inserting file into the database
    public function insert(){
          
        if (isset($_POST['submit'])){
            if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phoneNo']) && isset($_POST['password'])){
                if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['phoneNo']) && !empty($_POST['password'])){
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $phoneNo = $_POST['phoneNo'];
                    $password = sha1($_POST['password']);

                    $query = "INSERT INTO signuptable (username, email, phoneNo, password) VALUES ('$username',  '$email','$phoneNo', '$password')";
                    if($sql = $this->conn->query($query)){
                        echo "<script> alert('Record added successfully'); </script>";
                        echo "<script>   alertwindow.location.href = 'index.php'; </script>";
                    }else{
                    echo "<script> alert('failed'); </script>";
                    echo "<script> alertalertwindow.location.href = 'signup.php'; </script>";
                }
                }else{
                    echo "<script> alert('empty'); </script>";
                    echo "<script> alertalertwindow.location.href = 'signup.php'; </script>";
                }
            }
        
        }
    }

// fetching files
    public function fetch(){
        $data = null;

        $query = "SELECT * FROM signuptable";
        if($sql = $this->conn->query($query)){
            while($row = mysqli_fetch_assoc($sql)){
                $data[] = $row;
            }
        }
        return $data;
    }
    public function delete($id){
        $query = "DELETE FROM signuptable WHERE id= '$id'";
        if($sql = $this->conn->query($query)){
            return true;
        }else{
            return false;
        }
    }
    public function fetch_single($id){
        $data = null;

        $query = "SELECT * FROM signuptable WHERE id = '$id'";
        if($sql = $this->conn->query($query)){
            while($row = $sql->fetch_assoc()){
                $data = $row;
            }
        }
        return $data;

    }
    public function edit($id){

        $data = null;

        $query = "SELECT * FROM signuptable WHERE id = '$id'";
        if ($sql = $this->conn->query($query)) {
            while($row = $sql->fetch_assoc()){
                $data = $row;
            }
        }
        return $data;
    }

    public function update($data){

        $query = "UPDATE signuptable SET username='$data[username]', email='$data[email]', phoneNo='$data[phoneNo]' WHERE id='$data[id] '";

        if ($sql = $this->conn->query($query)) {
            return true;
        }else{
            return false;
        }
    }
  

} 

?>
