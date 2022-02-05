<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }        
    }

    
    public function getData(){
        

        $stmt = $this->db->prepare("SELECT * FROM prodotti ");
        
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;

        
    }

  
    public function getCategories(){
        $stmt = $this->db->prepare("SELECT * FROM categoria");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategoryById($idcategory){
        $stmt = $this->db->prepare("SELECT nomecategoria FROM categoria WHERE idcategoria=?");
        $stmt->bind_param('i',$idcategory);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPosts($n=-1){
        $query = "SELECT product_id, product_name, product_image, descformula, product_price, nome FROM prodotti, autore WHERE autore=idautore ORDER BY product_id DESC";
        if($n > 0){
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if($n > 0){
            $stmt->bind_param('i',$n);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostById($id){
        $query = "SELECT product_id, product_name, product_image, product_price, desccompletaformula, nome FROM prodotti, autore WHERE product_id=? AND autore=idautore";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostByCategory($idcategory){
        $query = "SELECT product_id, product_name, product_image, descformula, product_price, nome FROM prodotti, autore, prodotto_ha_categoria WHERE categoria=? AND autore=idautore AND product_id=prodotto";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idcategory);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostByIdAndAuthor($id, $idauthor){
        $query = "SELECT product_id, quantity,product_price, descformula, product_name, product_image, desccompletaformula, (SELECT GROUP_CONCAT(categoria) FROM prodotto_ha_categoria WHERE prodotto=product_id GROUP BY prodotto) as categorie FROM prodotti WHERE product_id=? AND autore=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$id, $idauthor);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostByAuthorId($id){
        $query = "SELECT product_id, product_name, product_image FROM prodotti WHERE autore=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertArticle($product_name, $desccompletaformula, $descformula, $product_image, $autore,$quantity, $price){
        $query = "INSERT INTO prodotti (product_name, desccompletaformula, descformula, product_image, autore, quantity, product_price) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssii',$product_name, $desccompletaformula, $descformula, $product_image, $autore, $quantity, $price);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function updateArticleOfAuthor($product_id, $product_name, $desccompletaformula, $descformula, $product_image, $autore, $quantity, $price){
        $query = "UPDATE prodotti SET product_name = ?, desccompletaformula = ?, descformula = ?, product_image = ?, quantity = ?, product_price = ? WHERE product_id = ? AND autore = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssiiii',$product_name, $desccompletaformula, $descformula, $product_image,$quantity, $price, $product_id, $autore);
       
        return $stmt->execute();
    }

    public function updateLoginUser($usernameOld, $usernameNew, $password, $name){
        $query = "UPDATE autore SET username = ?, password = ?, nome = ? WHERE username = ? ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss',$usernameNew, $password, $name, $usernameOld);
        
        return $stmt->execute();
    }

    public function deleteArticleOfAuthor($product_id, $autore){
        $query = "DELETE FROM prodotti WHERE product_id = ? AND autore = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$product_id, $autore);
        $stmt->execute();
        var_dump($stmt->error);
        return true;
    }

    public function insertCategoryOfArticle($prodotti, $categoria){
        $query = "INSERT INTO prodotto_ha_categoria (prodotto, categoria) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$prodotti, $categoria);
        return $stmt->execute();
    }

    public function deleteCategoryOfArticle($prodotti, $categoria){
        $query = "DELETE FROM prodotti_ha_categoria WHERE prodotto = ? AND categoria = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$prodotti, $categoria);
        return $stmt->execute();
    }

    public function deleteCategoriesOfArticle($prodotti){
        $query = "DELETE FROM prodotto_ha_categoria WHERE prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$prodotti);
        return $stmt->execute();
    }

    public function getAuthors(){
        $query = "SELECT username, nome, GROUP_CONCAT(DISTINCT nomecategoria) as argomenti FROM categoria, prodotto, autore, prodotto_ha_categoria WHERE product_id=prodotto AND categoria=idcategoria AND autore=idautore AND attivo=1 GROUP BY username, nome";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkLogin($username, $password){
        $query = "SELECT idautore, username, nome, attivo, password FROM autore WHERE username = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }    

    public function getQuantityById($idproduct){
        $stmt = $this->db->prepare("SELECT quantity FROM prodotti WHERE product_id=?");
        $stmt->bind_param('i', $idproduct);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function removeQnt($id, $qnt){
        $stmt = $this->db->prepare("UPDATE prodotti
        SET quantity=quantity-?
        WHERE product_id=? ");
        if(!$stmt){
            echo "err";
        }
        $stmt->bind_param("ii", $qnt, $id);
        $stmt->execute();
    }

    public function getNotifiche(){
        $stmt = $this->db->prepare("SELECT * FROM notifiche ");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function creaNotifica($product_id, $quantity, $total ,$text, $compratore){

        $query = "SELECT MAX(idnotifica) as max_product FROM notifiche ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $max = $stmt->get_result();
        $max = $max->fetch_array(MYSQLI_ASSOC);
        $max =  $max["max_product"] + 1;
        
        if($compratore == ""){
            $compratore = "anonimo";
        }

        $query = "INSERT INTO notifiche (idnotifica, idProdottoComprato, quantitaComprata,prezzoTotale, userCompratore, messaggio) VALUES (?, ?, ? , ?, ?, ?) ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iiiiss',$max, $product_id, $quantity, $total, $compratore,$text);
            
        
        
        $stmt->execute();
        
    }

}
?>