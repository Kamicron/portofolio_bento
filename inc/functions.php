<?php

/**
 * Convertit une date en format "AAAA-MM-JJ" en mois et année en français
 *
 * @param string $date La date à convertir
 * @return string La date au format "mois année" en français
 */
function date_fr($date) {
  // Configuration de la locale pour l'affichage des mois en français
  setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra');

  // Conversion de la date en format "mois année"
  $dateFr = utf8_encode(strftime('%B %Y', strtotime($date)));

  // Retour de la date formatée en français
  return $dateFr;
}
