<?php
define('MYSQL_HOST', 'localhost');
define('MYSQL_PORT', 3306);
define('MYSQL_NAME', 'portofolio');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', 'root');
define('URL', 'http://localhost/portofolio_bento');


/**
 * Connect to database
 *
 * @param null 
 * @return null
 */
function dbConnect()
{
    try {
        $database = new PDO(
            sprintf('mysql:host=%s;dbname=%s;port=%s', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT),
            MYSQL_USER,
            MYSQL_PASSWORD
        );
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return ($database);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/**
 * get all formations on the database
 *
 * @param null
 * @return array of formations
 */
function getFormation()
{
    $database = dbConnect();
    $sql = "
        SELECT title_row, sub_title_row, desc_row, date_start, type_name, tag_name 
        FROM `row`, `tag`, `type` ,`tag_has_row`
        WHERE row.type_idtype = type.idtype AND
        tag.idtag = tag_has_row .tag_idtag AND
        row.idrow = row_idrow AND
        type.idtype = 1
        ";
    $stmt = $database->prepare($sql);
    $stmt->execute();

    // Récupération des résultats de la requête
    $resultat = $stmt->fetchall();

    foreach ($resultat as $info) {
        $title = $info['title_row'];
        $infos[$title]['sub_title_row'] = $info['sub_title_row'];
        $infos[$title]['tag_name'][] = $info['tag_name'];
        $infos[$title]['desc_row'] = $info['desc_row'];
        $infos[$title]['date'] = date("Y", strtotime($info['date_start']));
    }
    return $infos;
}

function getExperience()
{
    $database = dbConnect();
    $sql = "
        SELECT row.title_row, row.sub_title_row, row.desc_row, row.date_start, row.date_end, tag.tag_name, type.type_name 
        FROM row, type, tag_has_row, tag 
        WHERE row.type_idtype=2 AND
        type.idtype=2 AND
        tag_has_row.tag_idtag = tag.idtag AND
        row.idrow = tag_has_row.row_idrow;
    ";
    $stmt = $database->prepare($sql);
    $stmt->execute();

    // Récupération des résultats de la requête
    $resultat = $stmt->fetchall();

    foreach ($resultat as $info) {
        $title = $info['title_row'];
        $infos[$title]['sub_title_row'] = $info['sub_title_row'];
        $infos[$title]['tag_name'][] = $info['tag_name'];
        $infos[$title]['desc_row'] = $info['desc_row'];
        $infos[$title]['date_start'] = date_fr($info['date_start']);
        $infos[$title]['date_end'] = date_fr($info['date_end']);
    }
    return $infos;
}

function getProject()
{
    $database = dbConnect();
    $sql = "
        SELECT row.title_row, row.sub_title_row, row.desc_row, row.date_start, row.date_end, tag.tag_name, type.type_name, image.name_img, image.alt_img  
        FROM row, type, tag_has_row, tag, image 
        WHERE row.type_idtype=3 AND
        type.idtype=3 AND
        tag_has_row.tag_idtag = tag.idtag AND
        row.idrow = tag_has_row.row_idrow AND
        image.idimage = row.image_idimage;
    ";
    $stmt = $database->prepare($sql);
    $stmt->execute();

    // Récupération des résultats de la requête
    $resultat = $stmt->fetchall();

    foreach ($resultat as $info) {
        $title = $info['title_row'];
        $infos[$title]['sub_title_row'] = $info['sub_title_row'];
        $infos[$title]['tag_name'][] = $info['tag_name'];
        $infos[$title]['desc_row'] = $info['desc_row'];
        $infos[$title]['date_start'] = date_fr($info['date_start']);
        $infos[$title]['date_end'] = date_fr($info['date_end']);
        $infos[$title]['name_img'] = $info['name_img'];
        $infos[$title]['alt_img'] = $info['alt_img'];
    }
        return $infos;

}
