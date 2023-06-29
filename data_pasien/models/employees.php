<?php
    class Employee{
        // Connection
        private $conn;
        // Table
        private $db_table = "Employee";
        // Columns
        public $id;
        public $nama;
        public $alamat;
        public $umur;
        public $kelamin;
        public $penyakit;
        public $created;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getEmployees(){
            $sqlQuery = "SELECT id, nama, alamat, umur, kelamin, penyakit, created FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createEmployee(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        nama = :nama, 
                        alamat = :alamat, 
                        umur = :umur, 
                        kelamin = :kelamin,
                        penyakit = :penyakit,  
                        created = :created";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nama=htmlspecialchars(strip_tags($this->nama));
            $this->alamat=htmlspecialchars(strip_tags($this->alamat));
            $this->umur=htmlspecialchars(strip_tags($this->umur));
            $this->kelamin=htmlspecialchars(strip_tags($this->kelamin));
            $this->penyakit=htmlspecialchars(strip_tags($this->penyakit));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":nama", $this->nama);
            $stmt->bindParam(":alamat", $this->alamat);
            $stmt->bindParam(":umur", $this->umur);
            $stmt->bindParam(":kelamin", $this->kelamin);
            $stmt->bindParam(":penyakit", $this->penyakit);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleEmployee(){
            $sqlQuery = "SELECT
                        id, 
                        nama, 
                        alamat, 
                        umur, 
                        kelamin,
                        penyakit, 
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nama = $dataRow['nama'];
            $this->alamat = $dataRow['alamat'];
            $this->umur = $dataRow['umur'];
            $this->kelamin= $dataRow['kelamin'];
            $this->penyakit= $dataRow['penyakit'];
            $this->created = $dataRow['created'];
        }        
        // UPDATE
        public function updateEmployee(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        nama = :nama, 
                        alamat = :alamat, 
                        umur = :umur, 
                        kelamin = :kelamin,
                        penyakit = :penyakit, 
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->nama=htmlspecialchars(strip_tags($this->nama));
            $this->alamat=htmlspecialchars(strip_tags($this->alamat));
            $this->umur=htmlspecialchars(strip_tags($this->umur));
            $this->kelamin=htmlspecialchars(strip_tags($this->kelamin));
            $this->penyakit=htmlspecialchars(strip_tags($this->penyakit));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":nama", $this->nama);
            $stmt->bindParam(":alamat", $this->alamat);
            $stmt->bindParam(":umur", $this->umur);
            $stmt->bindParam(":kelamin", $this->kelamin);
            $stmt->bindParam(":penyakit", $this->penyakit);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteEmployee(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>