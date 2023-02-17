<?php
  define('MYSQL_HOST','localhost') ;
  define('MYSQL_PORT',3306) ;
  define('MYSQL_NAME','portofolio') ;
  define('MYSQL_USER','root') ;
  define('MYSQL_PASSWORD','root') ;
  define('URL','http://localhost/portofolio_bento');
  
  
  //======================================//
  //       CONNEXION BASE DE DONNEE       //
  //======================================//
  function dbConnect()
  {
      try {
          $database = new PDO(
              sprintf('mysql:host=%s;dbname=%s;port=%s', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT),
              MYSQL_USER,
              MYSQL_PASSWORD
          );
          $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return($database); 
  
      } catch(Exception $e) {
          die('Erreur : '.$e->getMessage());
      }
  }
  //======================================//

  function getFormation() {
    $database=dbConnect();
    $sql = "
        SELECT title_row, sub_title_row, desc_row, date_start, type_name, tag_name 
        FROM `row`, `tag`, `type` ,`tag_has_type`
        WHERE row.type_idtype = type.idtype AND
        tag.idtag = tag_has_type.tag_idtag AND
        row.row_idrow = row_idrow AND
        type.type_name = formations";
    $stmt = $database->prepare($sql);
    $stmt->execute();
    
    // Récupération des résultats de la requête
    $resultat = $stmt->fetchall();
  
    return $resultat;
  }