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
        

        $statement = $this->db->prepare("SELECT * FROM prodotti ");
        
        $statement->execute();
        $result = $statement->get_result();

        return $result;

        
    }

    /**
     * Ritorno tutte le categorie nel db.
     */
    public function getCategories(){
        $statement = $this->db->prepare("SELECT * FROM categoria");
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Ritorno tutte le categorie dato un id.
     */
    public function getCategoryById($idcategory){
        $statement = $this->db->prepare("SELECT nomecategoria FROM categoria WHERE idcategoria=?");
        $statement->bind_param('i',$idcategory);
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Ritorno n post.
     */
    public function getPosts($n=-1){
        $query = "SELECT product_id, product_name, product_image, descformula, product_price, nome FROM prodotti, autore WHERE autore=idautore ORDER BY product_id DESC";
        if($n > 0){
            $query .= " LIMIT ?";
        }
        $statement = $this->db->prepare($query);
        if($n > 0){
            $statement->bind_param('i',$n);
        }
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Ritorno un determinato post dato un id.
     */
    public function getPostById($id){
        $query = "SELECT product_id, product_name, product_image, product_price, desccompletaformula, nome FROM prodotti, autore WHERE product_id=? AND autore=idautore";
        $statement = $this->db->prepare($query);
        $statement->bind_param('i',$id);
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Ritorna tutti i post data una categoria
     */
    public function getPostByCategory($idcategory){
        $query = "SELECT product_id, product_name, product_image, descformula, product_price, nome FROM prodotti, autore, prodotto_ha_categoria WHERE categoria=? AND autore=idautore AND product_id=prodotto";
        $statement = $this->db->prepare($query);
        $statement->bind_param('i',$idcategory);
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Ritorno il post dell'autore con quell id.
     */
    public function getPostByIdAndAuthor($id, $idauthor){
        $query = "SELECT product_id, quantity,product_price, descformula, product_name, product_image, desccompletaformula, (SELECT GROUP_CONCAT(categoria) FROM prodotto_ha_categoria WHERE prodotto=product_id GROUP BY prodotto) as categorie FROM prodotti WHERE product_id=? AND autore=?";
        $statement = $this->db->prepare($query);
        $statement->bind_param('ii',$id, $idauthor);
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Ritorno tutti i prodotti con quell'autore.
     */
    public function getPostByAuthorId($id){
        $query = "SELECT product_id, product_name, product_image FROM prodotti WHERE autore=?";
        $statement = $this->db->prepare($query);
        $statement->bind_param('i',$id);
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Ritorno un autore dato l'id del prodotto.
     */
    public function getAuthorByPostId($id_product){
        $query = "SELECT autore FROM prodotti WHERE product_id=? LIMIT 1 ";
        $statement = $this->db->prepare($query);
        $statement->bind_param('i',$id_product);
        $statement->execute();
        $result = $statement->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $id_autore = $result[0]["autore"];
        

        $query = "SELECT username FROM autore WHERE idautore=? ";
        $statement = $this->db->prepare($query);
        $statement->bind_param('i',$id_autore);
        $statement->execute();
        $result = $statement->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $name_autore = $result[0]["username"];

        return $name_autore;
    }

    /**
     * Inserisco un articolo.
     */
    public function insertArticle($product_name, $desccompletaformula, $descformula, $product_image, $autore,$quantity, $price){
        $query = "INSERT INTO prodotti (product_name, desccompletaformula, descformula, product_image, autore, quantity, product_price) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->db->prepare($query);
        $statement->bind_param('sssssii',$product_name, $desccompletaformula, $descformula, $product_image, $autore, $quantity, $price);
        $statement->execute();
        
        return $statement->insert_id;
    }

    /**
     * Aggiorno un articolo.
     */
    public function updateArticleOfAuthor($product_id, $product_name, $desccompletaformula, $descformula, $product_image, $autore, $quantity, $price){
        $query = "UPDATE prodotti SET product_name = ?, desccompletaformula = ?, descformula = ?, product_image = ?, quantity = ?, product_price = ? WHERE product_id = ? AND autore = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param('ssssiiii',$product_name, $desccompletaformula, $descformula, $product_image,$quantity, $price, $product_id, $autore);
       
        return $statement->execute();
    }

    /**
     * Aggiorna il possessore della notifica nel database 
     * cambiando l'user
     *
     * @param [type] $usernameNew
     * @param [type] $usernameOld
     * @return void
     */
    public function updateNotificheUser($usernameNew, $usernameOld){
        $query = "UPDATE notifiche SET userCompratore = ? WHERE userCompratore = ? ";
        $statement = $this->db->prepare($query);
        $statement->bind_param('ss',$usernameNew, $usernameOld);
        
        return $statement->execute();
    }

    /**
     * Aggiorna le credenziali nel database 
     *
     * @param [string] $usernameOld 
     * @param [string] $usernameNew
     * @param [string] $password
     * @param [string] $name
     * @return array
     */
    public function updateLoginUser($usernameOld, $usernameNew, $password, $name){
        $query = "SELECT username FROM autore WHERE username = ? ";
        $statement = $this->db->prepare($query);
        $statement->bind_param('s', $usernameNew);
        $statement->execute();
        $exist = $statement->get_result();
        $exist = $exist->fetch_array(MYSQLI_ASSOC);
        
        if(isset($exist) && count($exist) != 0){
            return 1;
        }
        $query = "UPDATE autore SET username = ?, password = ?, nome = ? WHERE username = ? ";
        $statement = $this->db->prepare($query);
        $statement->bind_param('ssss',$usernameNew, $password, $name, $usernameOld);
        /**
         * Aggiorna il possessore di quella notifica.
         * Questo per evitare che cambiando username tu non vedi piu la notifica.
         */
        $this->updateNotificheUser($usernameNew, $usernameOld);
        $statement->execute();
        
        return 0;
    }
    
    /**
     * Aggiorno la password e il nome quando l'username non è modificato.
     * Questo perche non verifico se l'username esiste gia.
     */
    public function updateOtherLoginUser($username, $password, $name){
        
        $query = "UPDATE autore SET username = ?, password = ?, nome = ? WHERE username = ? ";
        $statement = $this->db->prepare($query);
        $statement->bind_param('ssss',$username, $password, $name, $username);
        $statement->execute();
    
        return 0;
    }

    
    /**
     * Batteria di funzioni che eliminano dei prodotti dal db.
     */
    public function deleteArticleOfAuthor($product_id, $autore){
        $query = "DELETE FROM prodotti WHERE product_id = ? AND autore = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param('ii',$product_id, $autore);
        $statement->execute();
        
        return true;
    }

    public function insertCategoryOfArticle($prodotti, $categoria){
        $query = "INSERT INTO prodotto_ha_categoria (prodotto, categoria) VALUES (?, ?)";
        $statement = $this->db->prepare($query);
        $statement->bind_param('ii',$prodotti, $categoria);
        return $statement->execute();
    }

    public function deleteCategoryOfArticle($prodotti, $categoria){
        $query = "DELETE FROM prodotti_ha_categoria WHERE prodotto = ? AND categoria = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param('ii',$prodotti, $categoria);
        return $statement->execute();
    }

    public function deleteCategoriesOfArticle($prodotti){
        $query = "DELETE FROM prodotto_ha_categoria WHERE prodotto = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param('i',$prodotti);
        return $statement->execute();
    }

    /**
     * Ritorna l'autore.
     */
    public function getAuthors(){
        $query = "SELECT username, nome, GROUP_CONCAT(DISTINCT nomecategoria) as argomenti FROM categoria, prodotto, autore, prodotto_ha_categoria WHERE product_id=prodotto AND categoria=idcategoria AND autore=idautore AND attivo=1 GROUP BY username, nome";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Vedo se quell'username esiste nel db.
     */
    public function checkLogin($username, $password){
        $query = "SELECT idautore, username, nome, attivo, password FROM autore WHERE username = ? AND password = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param('ss',$username, $password);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }    

    /**
     * Ritorno la quantita di un prodotto con l'id.
     */
    public function getQuantityById($idproduct){
        $statement = $this->db->prepare("SELECT quantity FROM prodotti WHERE product_id=?");
        $statement->bind_param('i', $idproduct);
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * A seguito di un pagamento effettuato sottrae la quantita
     * comprata sul db.
     *
     * @param [int] $id
     * @param [int] $qnt
     * @return void
     */
    public function removeQnt($id, $qnt){
        $statement = $this->db->prepare("UPDATE prodotti
        SET quantity=quantity-?
        WHERE product_id=? ");
        if(!$statement){
            echo "err";
        }
        $statement->bind_param("ii", $qnt, $id);
        $statement->execute();
    }

    /**
     * Restituisce tutte le notifiche.
     * Chiamata SOLO dall'admin.
     *
     * @return array
     */
    public function getNotifiche($produttore){
        $statement = $this->db->prepare("SELECT * FROM notifiche WHERE produttore = ? ");
        $statement->bind_param("s", $produttore);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Restituisce tutte le notifiche di quell'user.
     *
     * @param [string] $username
     * @return void
     */
    public function getNotificheByUsername($username){
        $statement = $this->db->prepare("SELECT * FROM notifiche WHERE userCompratore = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Crea la notifica a seguito di un pagamento effettuato
     *
     * @param [int] $product_id
     * @param [int] $quantity
     * @param [int] $total
     * @param [string] $text
     * @param [string] $compratore
     * @return void
     */
    public function creaNotifica($product_id, $quantity, $total ,$text, $compratore, $produttore){

        $query = "SELECT MAX(idnotifica) as max_product FROM notifiche ";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $max = $statement->get_result();
        $max = $max->fetch_array(MYSQLI_ASSOC);
        $max =  $max["max_product"] + 1;
        
        if($compratore == ""){
            $compratore = "anonimo";
        }

        $query = "INSERT INTO notifiche (idnotifica, idProdottoComprato, quantitaComprata,prezzoTotale, userCompratore, messaggio, produttore) VALUES (?, ?, ? , ?, ?, ?, ?) ";
        $statement = $this->db->prepare($query);
        $statement->bind_param('iiiisss',$max, $product_id, $quantity, $total, $compratore,$text, $produttore);
            
        
        
        $statement->execute();
        
    }

    /**
     * Ritorna il prezzo dell'articolo dato un id.
     *
     * @param [int] $id
     * @return array
     */
    public function getPriceById($id){
        $query = "SELECT product_price FROM prodotti WHERE product_id = ? ";
        $statement = $this->db->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $price = $statement->get_result();
        return $price->fetch_array(MYSQLI_ASSOC);
    }

    /**
     * Inserisce un utente a seguito di una registrazione.
     * Controlla anche che quell'username non sia gia presente nel db. Se admin = 1 allora l'utente è venditore
     *
     * @param [string] $username
     * @param [string] $password
     * @param [string] $name
     * @param [int] $admin
     * @return void
     */
    public function registerUser($username, $password, $name, $admin){

        $query = "SELECT username FROM autore WHERE username = ? ";
        $statement = $this->db->prepare($query);
        $statement->bind_param('s', $username);
        $statement->execute();
        $exist = $statement->get_result();
        $exist = $exist->fetch_array(MYSQLI_ASSOC);
        
        if(isset($exist) && count($exist) != 0){
            return 1;
        }

        $query = "SELECT MAX(idautore) as max_id FROM autore ";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $max = $statement->get_result();
        $max = $max->fetch_array(MYSQLI_ASSOC);
        $max =  $max["max_id"] + 1;
        $attivo = $admin;
        


        $query = "INSERT INTO autore (idautore, username, password, nome, attivo) VALUES (?, ?, ?, ?, ?) ";
        
        $statement = $this->db->prepare($query);
        
        $statement->bind_param('isssi', $max, $username, $password, 
        $name, $attivo);
        $statement->execute();
    }

    /**
     * Elimina tutte le notifiche.
     * Lanciata solo dall'admin.
     *
     * @return void
     */
    public function deleteAllNotifiche($produttore){
        $query = "DELETE FROM notifiche WHERE produttore = ? ";
        $statement = $this->db->prepare($query);
        $statement->bind_param("s", $produttore);
        $statement->execute();
    }

    /**
     * Elimina le notifiche dato un username.
     *
     * @param [string] $username
     * @return void
     */
    public function deleteNotifiche($username){
        $query = "DELETE FROM notifiche WHERE userCompratore = ? ";
        $statement = $this->db->prepare($query);
        $statement->bind_param("s", $username);
        $statement->execute();
    }

    /**
     * Elimina le notifiche dato l'id.
     * 
     *
     * @param [string] $idnotifica
     * @return void
     */
    public function deleteNotificheById($idnotifica){
        $query = "DELETE FROM notifiche WHERE idnotifica = ? ";
        $statement = $this->db->prepare($query);
        $statement->bind_param("i", $idnotifica);
        $statement->execute();
    }

    /**
     * Notifica quando un prodotto è sold out.
     */

    public function soldOut($produttore){

        $query = "SELECT idautore FROM autore WHERE username=? ";
        $statement = $this->db->prepare($query);
        $statement->bind_param("s", $produttore);
        $statement->execute();
        $result = $statement->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $idautore = $result[0]["idautore"];


        $query = "SELECT product_name FROM prodotti WHERE quantity=0 AND autore = ? ";
        $statement = $this->db->prepare($query);
        $statement->bind_param("i", $idautore);
        $statement->execute();
        $result = $statement->get_result();


        return $result->fetch_all(MYSQLI_ASSOC);
    }


}
?>