<?php
//
// Copyright (C) 2004 W.H.Welch
// All rights reserved.
//
// This source file is part of the 404SEF Component, a Mambo 4.5.1
// custom Component By W.H.Welch - http://sef404.sourceforge.net/
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// Please note that the GPL states that any headers in files and
// Copyright notices as well as credits in headers, source files
// and output (screens, prints, etc.) can not be removed.
// You can extend them with your own credits, though...
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
//
// The "GNU General Public License" (GPL) is available at
// http://www.gnu.org/copyleft/gpl.html.
//
// Additions by Yannick Gaultier (c) 2006-2010
// Dont allow direct linking
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

define('_COM_SEF_404PAGE','Page erreur 404');
define('_COM_SEF_ADD','Ajouter');
define('_COM_SEF_ADDFILE','Fichier index par défaut.');
define('_COM_SEF_ASC',' (asc) ');
define('_COM_SEF_BACK','Retour au panneau de contrôle de sh404SEF');
define('_COM_SEF_BADURL','L\'ancienne URL (non optimisée) doit commencer par index.php');
define('_COM_SEF_CHK_PERMS','Merci de vérifier les permissions d\'accès aux fichier, et de contrôler que ce fichier peut être lu.');
define('_COM_SEF_CONFIG','sh404SEF<br/>Configuration');
define('_COM_SEF_CONFIG_DESC','Configurer sh404SEF');
define('_COM_SEF_CONFIG_UPDATED','Configuration mise à jour');
define('_COM_SEF_CONFIRM_ERASE_CACHE', 'Voulez-vous vider le cache URL ? Ceci est toujours recommandé après une modification de la configuration. Pour régénerer le cache, vous devez visiter de nouveau la page d&rsquo;accueil de votre site, ou mieux : créer un sitemap.');
define('_COM_SEF_COPYRIGHT','Copyright');
define('_COM_SEF_DATEADD','Date création');
define('_COM_SEF_DEBUG_DATA_DUMP','DUMP des données de DEBUG terminé: chargement de la page terminé');
define('_COM_SEF_DEF_404_MSG','<h1>Mauvaise pioche : cette page est introuvable !</h1>
<p>Vous avez demandé à visiter <strong>{%sh404SEF_404_URL%}</strong>, mais en dépit de tous nos efforst, nos ordinateurs n\ont pas réussi à la trouver. Que s\'est-il passé ?</p>
<ul>
<li>le lien sur lequel vous avez cliqué pour arriver ici comportait une erreur</li>
<li>ou bien nous avons effacé our changé le nom de cette page pour une raison ou une autre</li>
<li>or encore, quoique bien improbable, vous avez peut être fait une petite faute de frappe en tapant vous-même cette adresse ?</li>
</ul>
<h4>{sh404sefSimilarUrlsCommentStart}Tout n\'est pas perdu : nous pensons que les pages suivantes de notre site peuvent peut-être vous interesser également :{sh404sefSimilarUrlsCommentEnd}</h4>
<p>{sh404sefSimilarUrls}</p>
<p> </p>');
define('_COM_SEF_DEF_404_PAGE','Page 404 par défaut');
define('_COM_SEF_DESC',' (desc) ');
define('_COM_SEF_DISABLED',"<p class='error'>NOTE: l\'optimisation pour les moteurs de recherche (SEO) est actuellement désactivée dans les réglages de Joomla. Pour créer des URLs optimisées, merci d\'activer en premier lieu le système SEO intégré à Joomla : <a href='".$GLOBALS['shConfigLiveSite']."/administrator/index.php?option=com_config'>Configuration globale</a> SEO.</p>");
define('_COM_SEF_EDIT','Modifier');
define('_COM_SEF_EMPTYURL','Vous devez indiquer une URL vers laquelle rediriger.');
define('_COM_SEF_ENABLED','Activé');
define('_COM_SEF_ERROR_IMPORT','Erreur lors de l\'importation:');
define('_COM_SEF_EXPORT','Sauvegarder vos redirections personnalisées');
define('_COM_SEF_EXPORT_FAILED','Echec de l\'exportation!!!');
define('_COM_SEF_FATAL_ERROR_HEADERS','ERREUR FATALE: HEADER déjà envoyé');
define('_COM_SEF_FRIENDTRIM_CHAR','Caractères à supprimer début/fin');
define('_COM_SEF_HELP','Support<br/>sh404SEF');
define('_COM_SEF_HELPDESC','Aide sur sh404SEF?');
define('_COM_SEF_HELPVIA','<b>L\'aide est disponible au travers des forums :</b>');
define('_COM_SEF_HIDE_CAT','Masquer la catégorie');
define('_COM_SEF_HITS','Hits');
define('_COM_SEF_IMPORT','Importer des redirections personnalisées');
define('_COM_SEF_IMPORT_EXPORT','Importer/Exporter<br />redirections');
define('_COM_SEF_IMPORT_OK','Les URL personnalisées ont été importées correctement !');
define('_COM_SEF_INFO','Documentation<br/>sh404SEF');
define('_COM_SEF_INFODESC','Voir le descriptif du projet sh404SEF et sa documentation');
define('_COM_SEF_INSTALLED_VERS','Version installée:');
define('_COM_SEF_INVALID_SQL','Instructions SQL invalide dans le fichier:');
define('_COM_SEF_INVALID_URL','URL non valide: ce lien requiert un Itemid valide, mais aucun n\'a pu être trouvé.<br/>SOLUTION: Créez un élément de menu qui pointe vers cet élément. Vous n\'avez pas besoin de le publier, il sffit qu\'il existe.');
define('_COM_SEF_LICENSE','Licence');
define('_COM_SEF_LOWER','Tout en minuscules');
define('_COM_SEF_MAMBERS','Forum JoomlaFrance (forum.joomlafacile.com)');
define('_COM_SEF_NEWURL','URL non SEF');
define('_COM_SEF_NO_UNLINK','Impossible de supprimer le fichier envoyé dans le dossier media');
define('_COM_SEF_NOACCESS','Accès impossible');
define('_COM_SEF_NOCACHE','sans cache');
define('_COM_SEF_NOLEADSLASH','La nouvelle URL (optimisée) ne DOIT PAS COMMENCER par un /');
define('_COM_SEF_NOREAD','ERREUR FATALE: impossible de lire le fichier ');
define('_COM_SEF_NORECORDS','Aucun enregistrement trouvé.');
define('_COM_SEF_OFFICIAL','Forum du projet');
define('_COM_SEF_OK',' OK ');
define('_COM_SEF_OLDURL','URL SEF (optimisée)');
define('_COM_SEF_PAGEREP_CHAR','Séparateur de No de page');
define('_COM_SEF_PAGETEXT','Texte pages multiples');
define('_COM_SEF_PROCEED',' Valider ');
define('_COM_SEF_PURGE404','Effacer<br/>les erreurs 404');
define('_COM_SEF_PURGE404DESC','Vide le journal de suivi des erreurs 404');
define('_COM_SEF_PURGECUSTOM','Effacer<br/>redirections personnalisées');
define('_COM_SEF_PURGECUSTOMDESC','Efface les redirections personnalisées');
define('_COM_SEF_PURGEURL','Effacer<br/>les URLs');
define('_COM_SEF_PURGEURLDESC','Purge la liste des URLs optimisées');
define('_COM_SEF_REALURL','URL réelle');
define('_COM_SEF_RECORD',' enregistrement');
define('_COM_SEF_RECORDS',' enregistrements');
define('_COM_SEF_REPLACE_CHAR','Caractère de remplacement');
define('_COM_SEF_SAVEAS','Enregistrer comme redirection personnalisée');
define('_COM_SEF_SEFURL','URL optimisée');
define('_COM_SEF_SELECT_DELETE','Choisissez un élément à effacer');
define('_COM_SEF_SELECT_FILE','Merci de commencer par choisir un fichier');
define('_COM_SEF_SH_ACTIVATE_IJOOMLA_MAG', 'Activer gestion iJoomla magazine dans les articles');
define('_COM_SEF_SH_ADV_INSERT_ISO', 'Insertion du code ISO');
define('_COM_SEF_SH_ADV_MANAGE_URL', 'Traitement des URL');
define('_COM_SEF_SH_ADV_TRANSLATE_URL', 'Traduction des URL');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID', 'Toujours ajouter l&rsquo;Itemid à l&rsquo;URL SEF');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX','id menu');
define('_COM_SEF_SH_ALWAYS_INSERT_MENU_TITLE', 'Toujours insérer un titre');
define('_COM_SEF_SH_CACHE_TITLE', 'Gestion du cache');
define('_COM_SEF_SH_CAT_TABLE_SUFFIX', 'Table');
define('_COM_SEF_SH_CB_INSERT_NAME', 'Insérer nom Community Builder');
define('_COM_SEF_SH_CB_INSERT_USER_ID', 'Insérer identifiant utilisateur');
define('_COM_SEF_SH_CB_INSERT_USER_NAME', 'Insérer nom utilisateur');
define('_COM_SEF_SH_CB_NAME', 'Nom CB par défaut');
define('_COM_SEF_SH_CB_TITLE', 'Configuration Community Builder');
define('_COM_SEF_SH_CB_USE_USER_PSEUDO', 'Utiliser le pseudo');
define('_COM_SEF_SH_CONF_TAB_ADVANCED', 'Avancés');
define('_COM_SEF_SH_CONF_TAB_BY_COMPONENT', 'Par composant');
define('_COM_SEF_SH_CONF_TAB_MAIN', 'Principaux');
define('_COM_SEF_SH_CONF_TAB_PLUGINS', 'Plugins');
define('_COM_SEF_SH_DEFAULT_MENU_ITEM_NAME', 'Titre par défaut');
define('_COM_SEF_SH_DO_NOT_INSERT_LANGUAGE_CODE','Ne pas insérer code');
define('_COM_SEF_SH_DO_NOT_OVERRIDE_SEF_EXT', 'Utiliser plugin extension ou Joomla');
define('_COM_SEF_SH_DO_NOT_TRANSLATE_URL','Ne pas traduire');
define('_COM_SEF_SH_ENCODE_URL', 'Encoder les URL');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_ID', 'Insérer identifiant catégorie');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_NAME', 'Insérer le nom de la categorie');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_ID', 'Insérer identifiant message');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_SUBJECT', 'Insérer sujet du message');
define('_COM_SEF_SH_FB_INSERT_NAME', 'Insérer nom Kunena');
define('_COM_SEF_SH_FB_NAME', 'Nom Kunena par défaut');
define('_COM_SEF_SH_FB_TITLE', 'Configuration Kunena  ');
define('_COM_SEF_SH_FILTER', 'Filtre');
define('_COM_SEF_SH_FORCE_NON_SEF_HTTPS', 'Forcer non sef si HTTPS');
define('_COM_SEF_SH_GUESS_HOMEPAGE_ITEMID', 'Deviner l&rsquo;Itemid sur page d&rsquo;accueil');
define('_COM_SEF_SH_IJOOMLA_MAG_NAME', 'Nom magazine par défaut');
define('_COM_SEF_SH_IJOOMLA_MAG_TITLE', 'Configuration iJoomla Magazine');
define('_COM_SEF_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Insérer l&rsquo;Itemid du menu si aucun');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Insérer identifiant article');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'Insérer identifiant numéro');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'Insérer identifiant magazine');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_NAME', 'Insérer le nom du magazine dans les URL');
define('_COM_SEF_SH_INSERT_LANGUAGE_CODE', 'Insérer code langue dans les URL');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID', 'Insérer un identifiant unique dans l&rsquo;URL');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_ALL_CAT', 'Toutes les catégories');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'Appliquer à quelles catégories');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_TITLE', 'Identificateur unique');
define('_COM_SEF_SH_INSERT_PRODUCT_ID', 'Insérer identifiant produit');
define('_COM_SEF_SH_INSERT_TITLE_IF_NO_ITEMID', 'Insérer le titre de menu si pas d&rsquo;Itemid');
define('_COM_SEF_SH_ITEMID_TITLE', 'Gestion de l&rsquo;Itemid');
define('_COM_SEF_SH_LETTERMAN_DEFAULT_ITEMID', 'Itemid par défaut pour la page Letterman');
define('_COM_SEF_SH_LETTERMAN_TITLE', 'Configuration Letterman  ');
define('_COM_SEF_SH_LIVE_SECURE_SITE', 'URL en mode SSL');
define('_COM_SEF_SH_LOG_404_ERRORS', 'Enregistrer les erreurs 404');
define('_COM_SEF_SH_MAX_URL_IN_CACHE', 'Taille du cache');
define('_COM_SEF_SH_OVERRIDE_SEF_EXT', 'Utiliser plugin sh404sef');
define('_COM_SEF_SH_REDIR_404', '404');
define('_COM_SEF_SH_REDIR_CUSTOM', 'Perso.');
define('_COM_SEF_SH_REDIR_SEF', 'SEF');
define('_COM_SEF_SH_REDIR_TOTAL', 'Total');
define('_COM_SEF_SH_REDIRECT_JOOMLA_SEF_TO_SEF', 'Redirection 301 du SEF JOOMLA vers SEF');
define('_COM_SEF_SH_REDIRECT_NON_SEF_TO_SEF', 'Redirection 301 de non-SEF vers SEF');
define('_COM_SEF_SH_REPLACEMENTS', 'Liste de remplacements');
define('_COM_SEF_SH_SHOP_NAME', 'Nom boutique par défaut');
define('_COM_SEF_SH_TRANSLATE_URL', 'Traduire les URLs');
define('_COM_SEF_SH_TRANSLATION_TITLE', 'Gestion des traductions');
define('_COM_SEF_SH_USE_URL_CACHE', 'Activation du cache URL');
define('_COM_SEF_SH_VM_ADDITIONAL_TEXT', 'Ajouter texte additionel');
define('_COM_SEF_SH_VM_DO_NOT_SHOW_CATEGORIES', 'Aucune');
define('_COM_SEF_SH_VM_INSERT_CATEGORIES', 'Insérer nom catégories');
define('_COM_SEF_SH_VM_INSERT_CATEGORY_ID', 'Insérer identifiant catégorie');
define('_COM_SEF_SH_VM_INSERT_FLYPAGE', 'Insérer le nom de la flypage');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_ID', 'Insérer identifiant fabricant');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_NAME', 'Insérer le nom du fabricant');
define('_COM_SEF_SH_VM_INSERT_SHOP_NAME', 'Insérer le nom de la boutique');
define('_COM_SEF_SH_VM_SHOW_ALL_CATEGORIES', 'Toutes les catégories imbriquées');
define('_COM_SEF_SH_VM_SHOW_LAST_CATEGORY', 'La dernière seulement');
define('_COM_SEF_SH_VM_TITLE', 'Configuration Virtuemart');
define('_COM_SEF_SH_VM_USE_PRODUCT_SKU', 'Code produit à la place du nom');
define('_COM_SEF_SHOW_CAT', 'Inclure la catégorie');
define('_COM_SEF_SHOW_SECT','Inclure la section');
define('_COM_SEF_SHOW0','Montrer les URLs optimisées');
define('_COM_SEF_SHOW1','Montrer le journal d\'erreurs 404');
define('_COM_SEF_SHOW2','Montrer les redirections personnalisées');
define('_COM_SEF_SKIP','passer');
define('_COM_SEF_SORTBY','Classer par:');
define('_COM_SEF_STRANGE','Quelque chose de bizarre vient de se produire, et cela n\'aurait pas du arriver<br />');
define('_COM_SEF_STRIP_CHAR','Caractères à effacer');
define('_COM_SEF_SUCCESSPURGE','Enregistrements effacés.');
define('_COM_SEF_SUFFIX','Suffixe URL');
define('_COM_SEF_SUPPORT','Site<br/>support');
define('_COM_SEF_SUPPORT_404SEF','');
define('_COM_SEF_SUPPORTDESC','Allez sur le site de support de sh404SEF');
define('_COM_SEF_TITLE_ADV','Configuration avancée');
define('_COM_SEF_TITLE_BASIC','Configuration de base');
define('_COM_SEF_TITLE_CONFIG',' Configuration de sh404SEF');
define('_COM_SEF_TITLE_MANAGER','sh404SEF');
define('_COM_SEF_TITLE_PURGE','Vider la base de données des URLs sh404SEF');
define('_COM_SEF_TITLE_SUPPORT','Support sh404SEF');
define('_COM_SEF_TT_404PAGE','Article de contenu statique à utiliser quand une erreur 404 se produit (Page indisponible).');
define('_COM_SEF_TT_ADDFILE','Nom de fichier à ajouter après une URL vide, sans aucun nom de fichier.  Utile pour certain robots qui parcourent votre site à la recherche de fichier particulier, mais qui renvoient une erreur 404 au cas où ils ne le trouvent pas.');
define('_COM_SEF_TT_ADV','<b>traitement normal</b><br/>Traite normalement les URLs. Si un fichier extension SEO avancée est présent, il sera utilisé en lieu et place. <br/><b>sans cache</b><br/>ne pas stocker les URLs dans la base de données, et créer les URLs classiques de Joomla<br/><b>passer</b><br/>ne pas construire les URLs pour ce composant<br/>');
define('_COM_SEF_TT_ADV4','Options avancées');
define('_COM_SEF_TT_ENABLED','Si désactivé, le système SEO intégré à Joomla sera utilisé');
define('_COM_SEF_TT_FRIENDTRIM_CHAR','Caractères à supprimer au début et à la fin des URLS, séparés par des | (Alt-Gr + touche 6)');
define('_COM_SEF_TT_LOWER','Convertit les URLs en minuscules');
define('_COM_SEF_TT_NEWURL','Cette URL doit commencer par index.php');
define('_COM_SEF_TT_OLDURL','Vous ne pouvez entrer qu&rsquo;une URL relative (ne commençant pas par http://). Ne mettez pas non plus de / au début');
define('_COM_SEF_TT_PAGEREP_CHAR','Caractère pour séparer le numéro de page du reste des URLs');
define('_COM_SEF_TT_PAGETEXT','Texte à ajouter aux URLs dans le cas de pages multiples. Utilisez %s pour ajouter le n° de page. Par défaut, il sera ajouté à la fin. Si un suffixe a été défini ci-dessus, il sera ajouté à la fin de ce texte pour pages multiples.');
define('_COM_SEF_TT_REPLACE_CHAR','Caractère à utiliser pour remplacer les caractères inconnus dans une URL');
define('_COM_SEF_TT_SH_ACTIVATE_IJOOMLA_MAG', 'Si <strong>Activé</strong>, et qu&rsquo;un paramètre appellé &rsquo;ed&rsquo; est passé dans l&rsquo;URL d&rsquo;affichage d&rsquo;un article, il sera interprêté comme l&rsquo;identifiant d&rsquo;un numéro de magazine IJoomla.');
define('_COM_SEF_TT_SH_ADV_INSERT_ISO', 'Pour chaque composant installé, et si votre site est multi-lingue, indiquez si vous voulez insérer le code de langue dans les URL. Par exemple : www.monsite.com/<b>en</b>/introduction.html. Le code en indique l&rsquo;anglais. Notez que le code ne sera jamais inséré pour la langue par défaut du site.');
define('_COM_SEF_TT_SH_ADV_MANAGE_URL', 'Pour chaque composant installé :<br /><b>traitement normal</b><br/>Traite normalement les URLs. Si un fichier extension SEO avancée est présent, il sera utilisé en lieu et place. <br/><b>sans cache</b><br/>ne pas stocker les URLs dans la base de données, et créer les URLs classiques de Joomla<br/><b>passer</b><br/>ne pas construire les URLs pour ce composant<br/>');
define('_COM_SEF_TT_SH_ADV_OVERRIDE_SEF', 'Certains composants sont livrés avec des fichiers d&rsquo;extensions sef (sef_ext) destinés au SEF de Joomla, à OpenSEF ou SEF Advanced. Si ce paramètre est placé sur Remplacer extension SEF, l&rsquo;extension livrée avec le composant ne sera pas utilisée, mais remplacée par celle de sh404SEF (si elle existe bien sur). Dans le cas contraire, c&rsquo;est l&rsquo;extension livrée avec le composant qui sera mise en oeuvre.');
define('_COM_SEF_TT_SH_ADV_TRANSLATE_URL', 'Pour chaque composant installé, choisissez si les URL doivent être traduites ou non. Sans effet si votre site ne comporte qu’une seule langue.');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_ITEMID', 'Si activé, l&rsquo;Itemid de l&rsquo;URL non-sef (ou l&rsquo;Itemid de  l&rsquo;élément courant du menu si aucun ne figure dans l&rsquo;URL non-sef) sera ajouté à la fin de l&rsquo;URL sef. A utiliser à la place de Toujours insérer un titre si vous avez plusieurs éléments de menu qui portent le même titre (par exemple un dans le menu principal et un autre dans le menu supérieur).');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_MENU_TITLE', 'Si activé, le titre de l&rsquo;élément de menu désigné par l&rsquo;Itemid figurant dans l&rsquo;URL non-sef, ou celui de l&rsquo;élément de menu actif à défaut, sera inséré dans l&rsquo;URL SEF.');
define('_COM_SEF_TT_SH_CB_INSERT_NAME', 'Si <strong>Activé</strong>, le titre de l&rsquo;élément de menu qui conduit à Community builder sera systématiquement ajouté au début des URL sef');
define('_COM_SEF_TT_SH_CB_INSERT_USER_ID', 'Si <strong>Activé</strong>, l&rsquo;identifiant unique de chaque utilisateur sera ajouté avant son nom <strong>lorsque l&rsquo;option précédente est activée</strong>, dans le cas où deux utilisateurs auraient le même nom.');
define('_COM_SEF_TT_SH_CB_INSERT_USER_NAME', 'Si <strong>Activé</strong>, le nom de l&rsquo;utilisateur sera inséré dans les URLs. <strong>ATTENTION</strong>: ceci entraîne une augmentation significative de la place occupée dans la base de données, et peut ralentir le chargement des pages si vous avez beaucoup d&rsquo;utilisateurs inscrits. Si non activé, l&rsquo;identifiant de l&rsquo;utilisateur continue à être passée au format habituel (....?user=245 par exemple)');
define('_COM_SEF_TT_SH_CB_NAME', 'Quand le paramètre précédent est activé, vous pouvez saisir un nom, qui sera alors employé à la place du titre de l&rsquo;élément de menu. Notez bien qu&rsquo;alors ce nom est invariant, et en particulier qu&rsquo;il ne sera pas traduit.');
define('_COM_SEF_TT_SH_CB_USE_USER_PSEUDO', 'Si activé, le pseudonyme de l&rsquo;utilisateur sera employé au lieu de son nom dans les URL lorsque vous avez activé cette option (voir ci-dessus)');
define('_COM_SEF_TT_SH_DEFAULT_MENU_ITEM_NAME', 'Quand le paramètre ci-dessus est activé, vous pouvez saisir un titre ici, qui sera alors employé à la place des titres de menus. Notez bien qu&rsquo;alors ce titre est invariant, et en particulier qu&rsquo;il ne sera pas traduit.');
define('_COM_SEF_TT_SH_ENCODE_URL', 'Si activé, les URL produites par sh404SEF seront encodées de manière à être compatibles avec les langues ayant des caractères non latin. L&rsquo;encodage ressemble à : monsite.com/%34%56%E8%67%12.....');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_ID', 'Si activé, le nom de catégorie dans une URL sera toujours précédé de l&rsquo;identifiant interne de cette catégorie, ce qui est utile quand plusieurs catégories ont le même nom.');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_NAME', 'Si activé, le nom de la categorie du forum est inséré dans l&rsquo;URL sef pour tous les liens menant à l&rsquo;affichage d&rsquo;un post ou d&rsquo;une catégorie');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_ID', 'Si activé, le sujet du message dans une URL sera toujours précédé de l&rsquo;identifiant interne de ce sujet, ce qui est utile quand plusieurs sujets ont le même nom.');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_SUBJECT', 'Si activé, le sujet d&rsquo;un message sera inséré dans l&rsquo;URL sef pour tous les liens menant à l&rsquo;affichage de ce message');
define('_COM_SEF_TT_SH_FB_INSERT_NAME', 'Si <strong>Activé</strong>, le titre de l&rsquo;élément de menu qui conduit à Kunena sera systématiquement ajouté au début des URL sef');
define('_COM_SEF_TT_SH_FB_NAME', 'Quand le paramètre précédent est activé, vous pouvez saisir un nom, qui sera alors employé à la place du titre de l&rsquo;élément de menu. Notez bien qu&rsquo;alors ce nom est invariant, et en particulier qu&rsquo;il ne sera pas traduit.');
define('_COM_SEF_TT_SH_FORCE_NON_SEF_HTTPS', 'Si activé, toutes les URL resteront non sef en cas de passage au mode SSL (HTTPS). Cela permet de fonctionner avec certaines configuration de serveurs SSL partagés');
define('_COM_SEF_TT_SH_GUESS_HOMEPAGE_ITEMID', 'Si activé, sur la page d&rsquo;accueil, l&rsquo;Itemid des URL menant à des articles (com_content) sera supprimé et remplacé par celui que sh404SEF recherchera. Cela permet d&rsquo;éviter que les articles visibles à la fois sur la page d&rsquo;accueil et sur une autre page ne puissent être vus que sur la page d&rsquo;accueil.');
define('_COM_SEF_TT_SH_IJOOMLA_MAG_NAME', 'Quand le paramètre ci-dessus est activé, vous pouvez saisir un nom, qui sera alors employé à la place du titre de l&rsquo;élément de menu. Notez bien qu&rsquo;alors ce nom est invariant, et en particulier qu&rsquo;il ne sera pas traduit.');
define('_COM_SEF_TT_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Si aucun Itemid n&rsquo;est présent dans l&rsquo;URL non-SEF avant sa transformation en URL sef, et que vous activez cette option, l&rsquo;Itemid de l&rsquo;élément de menu courant sera ajouté à cette URL non-sef. De cette manière, si l&rsquo;on clique sur ce lien, on restera sur la même page, c&rsquo;est à dire que les mêmes modules par exemple seront affichés.)');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Si <strong>activé</strong>, le titre d&rsquo;un article dans une URL sera toujours précédé de l&rsquo;identifiant interne de cet article. Par exemple: <br /> monsite.com/Joomla-magazine/<strong>56</strong>-titre-de-super-article.html');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'Si <strong>Activé</strong>, l&rsquo;identifiant interne unique du numéro sera inséré avant le titre, afin d&rsquo;être sur qu&rsquo;il soit unique.');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'Si <strong>activé</strong>, le titre du magazine dans une URL sera toujours précédé de l&rsquo;identifiant interne de ce magazine<br />par exemple : monsite.com/<strong>6</strong>-nom du magazine/titre-de-mon-article.html.');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_NAME', 'Si <strong>Activé</strong>, le nom du magazine (c&rsquo;est à dire le titre de l&rsquo;élément de menu qui y conduit), sera systématiquement ajouté au début des URL sef');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID', 'Si <strong>Activé</strong>, un identificateur numérique sera inséré dans l&rsquo;URL, pour faciliter son inclusion dans des services de nouvelles comme Google news. L&rsquo;identifiant aura le format suivant : 2007041100000, avec 20070411 la date de création de l&rsquo;article et 00000 l&rsquo;identifiant unique interne à Joomla de l&rsquo;article. Pensez à mettre à jour la date de création de votre article lorsque vous le publiez une fois terminé. Par contre, vous ne devrez plus changer cette date de création une fois l&rsquo;article publié.');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'L&rsquo;identifiant numérique sera seulement inséré dans les URL des articles des catégories que vous sélectionnez ici. Vous pouvez sélectionner plusieurs catégories en apuuyant et maintenant la touche Ctrl avant de cliquer sur le nom d&rsquo;une catégorie.');
define('_COM_SEF_TT_SH_INSERT_PRODUCT_ID', 'Si activé, le nom d&rsquo;un produit dans une URL sera toujours précédé de l&rsquo;identifiant interne de ce produit<br />Par exemple, monsite.com/3-mon-tres-beau-produit.html.<br />C&rsquo;est utile en particulier si vous n&rsquo;utilisez pas tous les noms de catégories, car des produits dans des catégories différentes peuvent porter le même nom. Notez bien que l&rsquo;on parle ici de l&rsquo;identifiant interne du produit, qui est toujours unique, et non du code produit (SKU) que vous entrez pour chaque produit.');
define('_COM_SEF_TT_SH_INSERT_TITLE_IF_NO_ITEMID', 'Si aucun Itemid n&rsquo;est présent dans l&rsquo;URL non-SEF avant sa transformation en URL sef, et que vous activez cette option, le titre de l&rsquo;élément actif de menu sera inséré dans l&rsquo;URL sef. Ce paramètre devrait être activé si le précédent l&rsquo;est, car cela devrait empêcher la formation d&rsquo;URLs se terminant par -2, -3, -... quand un même article est vu sur plusieurs pages, sans pour autant être accessible directement depuis un lien dans un menu, ou bien une table de catégories ou de section.');
define('_COM_SEF_TT_SH_LETTERMAN_DEFAULT_ITEMID', 'Entrez l&rsquo;Itemid à insérer dans les liens générés par Letterman : désinscription, messages de confirmation, ...');
define('_COM_SEF_TT_SH_LIVE_SECURE_SITE', '<strong>Indiquez ici l&rsquo;URl à utiliser lors du passage en mode SSL (https)</strong>.<br />Nécessaire seulement si vous utilisez un accès de type https. Si vous laissez vide, et que vous utilisez https, sh404SEF emploiera l&rsquo;adresse http<strong>S</strong>://URLNormaleDuSite.<br />Entrez une adresse complète, sans / à la fin. Exemple : <strong>https://www.monsite.com</strong> ou <strong>https://serveurSSLpartage.fr/moncompte</strong>.');
define('_COM_SEF_TT_SH_LOG_404_ERRORS', 'Si <strong>Activé</strong>, les erreurs 404 se produisant seront enregistrées dans la base de données. Cela permet de détecter d&rsquo;éventuelles erreurs dans votre site. Cela peut aussi prendre de l&rsquo;espace inutile, et vous pouvez donc probablement le désactiver une fois la phase de mise au point de votre site terminée.');
define('_COM_SEF_TT_SH_MAX_URL_IN_CACHE', 'Lorsque la mise en cache des URLs est activée, ce paramètre limite sa taille. Entrez le nombre d URLs à mettre en cache au maximum (les URLs au delà de cette limite seront toujours traitées, mais pas mises en cache, et le temps de chargement sera plus élevé). En première approche, chaque URL pèse à peu près 200 octets (100 pour l URL SEF, et 100 pour l URL non SEF. Donc, par exemple, 5000 URLs occuperont environ 1 Mo.');
define('_COM_SEF_TT_SH_REDIRECT_JOOMLA_SEF_TO_SEF', 'Si réglé sur <strong>Oui</strong>, sh404sef tentera de rediriger les URL SEF standard de JOOMLA (redirection 301) vers leur équivalent SEF s&rsquo;&rsquo;il existe déjà dans la base de données. S&rsquo;&rsquo;il n&rsquo;existe pas, il est créé, sauf si la page comporte des données transmises par POST, auquel cas rien n&rsquo;&rsquo;est fait. Attention: cette function operera la plupart du temps sans problème, mais peut quelquefois dysfonctionner pour certaines urls. Il est conseillé de la laisser sur off, ou de bien tester les url de sont site avant de passer en production.');
define('_COM_SEF_TT_SH_REDIRECT_NON_SEF_TO_SEF', 'Si réglé sur <strong>Oui</strong>, les URL non-sef seront automatiquement redirigée (redirection 301) vers leur équivalent SEF s&rsquo;&rsquo;il existe déjà dans la base de données. S&rsquo;&rsquo;il n&rsquo;existe pas, il est créé, sauf si la page comporte des données transmises par POST, auquel cas rien n&rsquo;&rsquo;est fait.');
define('_COM_SEF_TT_SH_REPLACEMENTS', 'Les caractères non valides dans des URLs, comme les caractères accentués par exemple, peuvent être remplacés suivant la table saisie ici. <br />Le format est xxx | yyy pour chaque règle de remplacement. xxx est le caractère à remplacer, et yyy est le caractère à employer à la place. <br />Il peut y avoir plusiers règles, séparées par des virgules (,). Entre l&rsquo;ancien et le nouveau caractère, placez un | (touche AltGr + touche 6 en haut du clavier. <br />Notez que xxx et yyy peuvent être des caractères multiples, comme dans Œ|oe ');
define('_COM_SEF_TT_SH_SHOP_NAME', 'Quand le paramètre ci-dessus est activé, vous pouvez saisir un nom ici, qui sera alors employé à la place des titres de menus. Notez bien qu&rsquo;alors ce nom est invariant, et en particulier qu&rsquo;il ne sera pas traduit.');
define('_COM_SEF_TT_SH_USE_URL_CACHE', 'Si activé, les URLs ré-écrites sont chargées dans un cache en mémoire, ce qui accélère beaucoup le temps de création des pages. Par contre, cela consomme de la mémoire!');
define('_COM_SEF_TT_SH_VM_ADDITIONAL_TEXT', 'Si <strong>Activé</strong>, un texte additionnel sera ajouté aux URL, quand on parcourt les catégories. Par exemple : ..../categorie-A/voir-tous-les-produits.html à la place de ..../categorie-A/ .');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORIES', 'Si réglé sur <strong>Aucune</strong>, aucun nom de catégorie ne sera inséré dans les URL sef menant à une page produit, par exemple : <br /> monsite.com/joomla-cms.html<br />Si réglé sur <strong>La dernière seulement</strong>, le nom de la catégorie à laquelle appartient le produit sera inséré dans l&rsquo;URL sef, par exemple: <br /> monsite.com/php-mysql/joomla-cms.html<br />Si réglé sur <strong>Toutes les catégories imbriquées</strong>, le nom de toute la succession de catégories auxquelles appartient le produit sera inséré, par exemple : <br /> monsite.com/logiciels/cms/php-mysql/joomla-cms.html');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORY_ID', 'Si activé, le nom d&rsquo;une catégorie sera toujours précédé dans les URL sef menant à une page produit d&rsquo;un identifiant unique, par exemple : <br /> monsite.com/2-logiciels/6-cms/2-php-mysql/joomla-cms.html');
define('_COM_SEF_TT_SH_VM_INSERT_FLYPAGE', 'Si activé, le nom de la flypage sera inséré dans l&rsquo;URL menant à un produit. Cela peut être désactivé si vous n&rsquo;utilisez qu&rsquo;une seule flypage, et si vous n&rsquo;utilisez pas le bouton PDF.');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_ID', 'Si activé, le nom d&rsquo;un fabricant dans une URL sera toujours précédé de l&rsquo;identifiant interne de ce fabricant<br />par exemple : monsite.com/6-nom-du-fabricant/mon-tres-beau-produit.html.');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_NAME', 'Si activé, le nom du fabricant, s&rsquo;il y en a un pour ce produit, est inséré dans l&rsquo;URL sef pour toutes les liens menant à l&rsquo;affichage d&rsquo;un produit.<br />Par exemple : monsite.com/nom-du-fabricant/nom-du-produit.html');
define('_COM_SEF_TT_SH_VM_INSERT_SHOP_NAME', 'Si activé, le nom de la boutique (c&rsquo;est à dire le titre de l&rsquo;élément de menu qui y conduit), sera systématiquement ajouté au début des URL sef.');
define('_COM_SEF_TT_SH_VM_USE_PRODUCT_SKU', 'Si activé, le code produit (aussi appelé SKU par Virtuemart) sera utilisé en lieu et place du nom complet du produit.');
define('_COM_SEF_TT_SHOW_CAT','Si activé, la catégorie à laquelle appartient un article sera utilisée pour construire son URL');
define('_COM_SEF_TT_SHOW_SECT','Si activé, la SECTION à laquelle appartient un article sera utilisée pour construire son URL');
define('_COM_SEF_TT_STRIP_CHAR','Caractères qui doivent être effacés des URLS, séparés par des | (Alt-Gr + touche 6)');
define('_COM_SEF_TT_SUFFIX','Extension ajoutées aux URLS. Laissez blanc pour ne rien ajouter. La plupart du temps, on utilise html');
define('_COM_SEF_TT_USE_ALIAS','Si activé, le champ Alias de titre des articles sera utilisé à la place du titre pour construire les URLs');
define('_COM_SEF_UNWRITEABLE',' <b><font color="red">Non modifiable</font></b>');
define('_COM_SEF_UPLOAD_OK','Le fichier a été envoyé avec succès');
define('_COM_SEF_URL','URL');
define('_COM_SEF_URLEXIST','Cette URL existe déjà dans la base de données!');
define('_COM_SEF_USE_ALIAS','Utiliser alias de titre');
define('_COM_SEF_USE_DEFAULT','(traitement normal)');
define('_COM_SEF_USING_DEFAULT',' <b><font color="red">Utilisation des valeurs par défaut</font></b>');
define('_COM_SEF_VIEW404','Journal des<br/>erreurs 404');
define('_COM_SEF_VIEW404DESC','Voir/modifier le journal d\'erreur 404');
define('_COM_SEF_VIEWCUSTOM','redirections<br/>personnalisées');
define('_COM_SEF_VIEWCUSTOMDESC','Voir/modifier les redirections personnalisées ');
define('_COM_SEF_VIEWMODE','Mode:');
define('_COM_SEF_VIEWURL','URLs<br/>optimisées');
define('_COM_SEF_VIEWURLDESC','Voir/modifier les URLs optimisées');
define('_COM_SEF_WARNDELETE','ATTENTION!!! Vous allez effacer ');
define('_COM_SEF_WRITE_ERROR','Erreur lors de la sauvegarde de la configuration');
define('_COM_SEF_WRITE_FAILED','Impossible de sauver le fichier envoyé dans le dossier media');
define('_COM_SEF_WRITEABLE',' <b><font color="green">Modifiable</font></b>');
define('_FULL_TITLE', 'Titre complet');
define('_PREVIEW_CLOSE','Fermer cette fenêtre');
define('_TITLE_ALIAS', 'Alias de titre');

// V 1.2.4.s
define('_COM_SEF_SH_DOCMAN_TITLE', 'Configuration Docman');
define('_COM_SEF_SH_DOCMAN_INSERT_NAME', 'Insérer nom Docman');
define('_COM_SEF_TT_SH_DOCMAN_INSERT_NAME', 'Si <strong>Activé</strong>, le titre de l&rsquo;élément de menu qui conduit à Docman sera systématiquement ajouté au début des URL sef');
define('_COM_SEF_SH_DOCMAN_NAME', 'Nom Docman par défaut');
define('_COM_SEF_TT_SH_DOCMAN_NAME', 'Quand le paramètre précédent est activé, vous pouvez saisir un nom, qui sera alors employé à la place du titre de l&rsquo;élément de menu. Notez bien qu&rsquo;alors ce nom est invariant, et en particulier qu&rsquo;il ne sera pas traduit.');
define('_COM_SEF_SH_DOCMAN_INSERT_DOC_ID', 'Insérer identifiant document');
define('_COM_SEF_TT_SH_DOCMAN_INSERT_DOC_ID', 'Si activé, le titre d&rsquo;un document dans une URL sera toujours précédé de l&rsquo;identifiant interne de ce document, ce qui est utile quand plusieurs documents ont le même nom.');
define('_COM_SEF_SH_DOCMAN_INSERT_DOC_NAME', 'Insérer nom du document');
define('_COM_SEF_TT_SH_DOCMAN_INSERT_DOC_NAME', 'Si activé, le nom du document sera inséré dans l&rsquo;URL sef pour tous les liens menant à une action sur ce document');
define('_COM_SEF_SH_MYBLOG_TITLE', 'Configuration MyBlog');
define('_COM_SEF_SH_MYBLOG_INSERT_NAME', 'Insérer nom MyBlog');
define('_COM_SEF_TT_SH_MYBLOG_INSERT_NAME', 'Si <strong>Activé</strong>, le titre de l&rsquo;élément de menu qui conduit à MyBlog sera systématiquement ajouté au début des URL sef');
define('_COM_SEF_SH_MYBLOG_NAME', 'Nom Myblog par défaut');
define('_COM_SEF_TT_SH_MYBLOG_NAME', 'Quand le paramètre précédent est activé, vous pouvez saisir un nom, qui sera alors employé à la place du titre de l&rsquo;élément de menu. Notez bien qu&rsquo;alors ce nom est invariant, et en particulier qu&rsquo;il ne sera pas traduit.');
define('_COM_SEF_SH_MYBLOG_INSERT_POST_ID', 'Insérer identifiant post');
define('_COM_SEF_TT_SH_MYBLOG_INSERT_POST_ID', 'Si activé, le titre du post dans une URL sera toujours précédé de l&rsquo;identifiant interne de ce post, ce qui est utile quand plusieurs posts ont le même nom.');
define('_COM_SEF_SH_MYBLOG_INSERT_TAG_ID', 'Insérer identifiant tag');
define('_COM_SEF_TT_SH_MYBLOG_INSERT_TAG_ID', 'Si activé, le nom d&rsquo;un tag dans une URL sera toujours précédé de l&rsquo;identifiant interne de ce tag, ce qui est utile quand plusieurs tags ont le même nom.');
define('_COM_SEF_SH_MYBLOG_INSERT_BLOGGER_ID', 'Insérer identifiant blogueur');
define('_COM_SEF_TT_SH_MYBLOG_INSERT_BLOGGER_ID', 'Si activé, le nom d&rsquo;un blogueur dans une URL sera toujours précédé de l&rsquo;identifiant interne de ce blogueur, ce qui est utile quand plusieurs blogueurs ont le même nom.');
define('_COM_SEF_SH_RW_MODE_NORMAL', 'avec .htaccess (mod_rewrite)');
define('_COM_SEF_SH_RW_MODE_INDEXPHP', 'sans .htaccess (index.php)');
define('_COM_SEF_SH_RW_MODE_INDEXPHP2', 'sans .htaccess (index.php?)');
define('_COM_SEF_SH_SELECT_REWRITE_MODE', 'Mode de ré-écriture');
define('_COM_SEF_TT_SH_SELECT_REWRITE_MODE', 'Choix du mode de fonctionnement de sh404SEF.<br /><strong>avec .htaccess (mod_rewrite)</strong><br />Mode classique : vous devez avoir un fichier .htaccess, configuré en fonction de votre serveur<br /><strong>sans .htaccess (index.php)</strong><br /><strong>EXPERIMENTAL :</strong>Vous n&rsquo;avez pas besoin de fichier .htaccess. Ce mode met à profit la fonctionn PathInfo du serveur Apache. Les urls comportent la chaine /index.php/. Il est possible que les serveurs IIS acceptent ce mode de fonctionnement<br /><strong>sans .htaccess (index.php?)</strong><br /><strong>EXPERIMENTAL :</strong>Vous n&rsquo;avez pas besoin de fichier .htaccess. Ce mode est identique au précédent, mais la chaine insérée est /index.php?/. Il est possible que les serveurs IIS acceptent ce mode de fonctionnement<br />');
define('_COM_SEF_SH_RECORD_DUPLICATES', 'Enregistrer URL dupliquées');
define('_COM_SEF_TT_SH_RECORD_DUPLICATES', 'Si activé, sh404SEF enregistrera dans la base de données toutes les URLs non sef correspondants à la même SEF URL. Cela vous permettra de choisir celle que vous voulez utiliser, avec la fonction Gérer dupliquées dans l&rsquo;écran de visualisation des URL SEF.');
define('_COM_SEF_META_TITLE', 'Balise Titre');
define('_COM_SEF_TT_META_TITLE', 'Saisissez le texte à insérer dans la balise <strong>META Titre</strong> pour la page correspondant à l&rsquo;URL actuelle.');
define('_COM_SEF_META_DESC', 'Balise Description');
define('_COM_SEF_TT_META_DESC', 'Saisissez le texte à insérer dans la balise <strong>META Description</strong> pour la page correspondant à l&rsquo;URL actuelle. ');
define('_COM_SEF_META_KEYWORDS', 'Balise Keywords');
define('_COM_SEF_TT_META_KEYWORDS', 'Saisissez le texte à insérer dans la balise <strong>META Keywords</strong> pour la page correspondant à l&rsquo;URL actuelle. Chaque mot ou groupe de mots doit être séparé du précédent par une virgule.');
define('_COM_SEF_META_ROBOTS', 'Balise Robots');
define('_COM_SEF_TT_META_ROBOTS', 'Saisissez le texte à insérer dans la balise <strong>META Robots</strong> pour la page correspondant à l&rsquo;URL actuelle. Cette balise indique aux moteurs de recherche s&rsquo;ils doivent suivre les liens figurant sur la page, et s&rsquo;ils doivent en indexer le contenu. Exemples courants :<br /><strong>INDEX,FOLLOW</strong> : indexer le contenu de la page, et suivre les liens<br /><strong>INDEX,NO FOLLOW</strong> : indexer le contenu de la page, mais ne pas suivre les liens qu&rsquo;elle comporte<br /><strong>NO INDEX, NO FOLLOW</strong> : ne pas indexer le contenu de la page, et ne pas suivre les liens<br />');
define('_COM_SEF_META_LANG', 'Balise Language');
define('_COM_SEF_TT_META_LANG', 'Saisissez le texte à insérer dans la balise <strong>META http-equiv= Content-Language </strong> pour la page correspondant à l&rsquo;URL actuelle. ');
define('_COM_SEF_SH_CONF_TAB_META', 'Meta/SEO');
define('_COM_SEF_SH_CONF_META_DOC', 'sh404SEF est équipé de plugins pour la création <strong>automatique</strong> des balises META pour un certain nombre de composants. Ne les créez manuellement que si vous les valeurs calculées automatiquement ne vous satisfont pas!<br>');
define('_COM_SEF_SH_REMOVE_JOOMLA_GENERATOR', 'Supprimer Joomla Generator');
define('_COM_SEF_TT_SH_REMOVE_JOOMLA_GENERATOR', 'Si activé, balise meta Generator = Joomla sera supprimée de toute les pages');
define('_COM_SEF_SH_PUT_H1_TAG', 'Insérer des tags h1');
define('_COM_SEF_TT_SH_PUT_H1_TAG', 'Si activé, les titres des articles normaux de Joomla seront placés entre des balises HTML h1. Il s&rsquo;agit des titres ayant des classes CSS commençant par contentheading.');
define('_COM_SEF_SH_META_MANAGEMENT_ACTIVATED', 'Activer la gestion Meta');
define('_COM_SEF_TT_SH_META_MANAGEMENT_ACTIVATED', 'Si activé, les balises META Titre, Description, Keywords, Robots et Language seront gérées par sh404SEF. Sinon, les valeurs originales produites par Joomla et/ou les composants installés seront laissées telles quelles. ');
define('_COM_SEF_TITLE_META_MANAGEMENT', 'Gestion des balises meta');
define('_COM_SEF_META_EDIT', 'Modifier les balises');
define('_COM_SEF_META_ADD', 'Ajouter des balises');
define('_COM_SEF_META_TAGS', 'Balises META');
define('_COM_SEF_META_TAGS_DESC', 'Créer/modifier les balises Meta');
define('_COM_SEF_PURGE_META_DESC', 'Effacer les balises Meta');
define('_COM_SEF_PURGE_META', 'Effacer META');
define('_COM_SEF_IMPORT_EXPORT_META', 'Importer/ exporter META');
define('_COM_SEF_NEW_META', 'Nouvelle META');
define('_COM_SEF_NEWURL_META', 'URL non SEF');
define('_COM_SEF_TT_NEWURL_META', 'Entrez l&rsquo;URL non SEF pour laquelle vous voulez saisir des balises Meta. ATTENTION: elle doit obligatoirement commencer par <strong>index.php</strong>!');
define('_COM_SEF_BAD_META', 'Merci de vérifier vos saisies : données invalides.');
define('_COM_SEF_META_TITLE_PURGE', 'Effacement des balises Meta');
define('_COM_SEF_META_SUCCESS_PURGE', 'Balises Meta effacées');
define('_COM_SEF_IMPORT_META', 'Importer balises Meta');
define('_COM_SEF_EXPORT_META', 'Exporter balises Meta');
define('_COM_SEF_IMPORT_META_OK', 'Importation réussie des balises meta');
define('_COM_SEF_SELECT_ONE_URL', 'Merci de sélectionner une (et une seule) URL.');
define('_COM_SEF_MANAGE_DUPLICATES', 'Gestion URL pour : ');
define('_COM_SEF_MANAGE_DUPLICATES_RANK', 'Rang');
define('_COM_SEF_MANAGE_DUPLICATES_BUTTON', 'URL dupliquées');
define('_COM_SEF_MANAGE_MAKE_MAIN_URL', 'URL principale');
define('_COM_SEF_BAD_DUPLICATES_DATA', 'Erreur : données URL invalides');
define('_COM_SEF_BAD_DUPLICATES_NOTHING_TO_DO', 'Cette URL est déjà l&rsquo;URL principale');
define('_COM_SEF_MAKE_MAIN_URL_OK', 'Opération réussie');
define('_COM_SEF_MAKE_MAIN_URL_ERROR', 'Echec lors de l&rsquo;opération');
define('_COM_SEF_SH_CONTENT_TITLE', 'Configuration contenu');
define('_COM_SEF_SH_INSERT_CONTENT_TABLE_NAME', 'Insérer nom table articles');
define('_COM_SEF_TT_SH_INSERT_CONTENT_TABLE_NAME', 'Si activé, le nom de l&rsquo;élément de menu qui mène à un tableau d&rsquo;articles sera inséré dans les URL créées, afin de distinguer les liens de type blog de ceux de type Tableau');
define('_COM_SEF_SH_CONTENT_TABLE_NAME', 'Nom tables par défaut');
define('_COM_SEF_TT_SH_CONTENT_TABLE_NAME', 'Quand le paramètre précédent est activé, vous pouvez saisir un titre ici, qui sera alors employé à la place des titres de menus. Notez bien qu&rsquo;alors ce titre est invariant, et en particulier qu&rsquo;il ne sera pas traduit.');
define('_COM_SEF_SH_REDIRECT_WWW', 'Redirection 301 www/non-www');
define('_COM_SEF_TT_SH_REDIRECT_WWW', 'Si activé, sh404SEF effectuera une redirection 301 en cas d&rsquo;accès par une URL sans www au début si l&rsquo;adresse du site commence par www., ou en cas d&rsquo;accès par une URL ave www si l&rsquo;adresse du site ne commence pas par www. Permet d&rsquo;éviter des pénalités pour contenu dupliqué, et aussi certains dysfonctionnements au niveau du serveur ou de Joomla (éditeurs de texte notamment)');
define('_COM_SEF_SH_INSERT_PRODUCT_NAME', 'Insérer nom du produit');
define('_COM_SEF_TT_SH_INSERT_PRODUCT_NAME', 'Si activé, le nom du produit sera inséré dans l&rsquo;URL créée');
define('_COM_SEF_SH_VM_USE_PRODUCT_SKU_124S', 'Insérer code produit');
define('_COM_SEF_TT_SH_VM_USE_PRODUCT_SKU_124S', 'Si activé, le code produit (aussi appelé SKU par Virtuemart) sera inséré dans l&rsquo;URL créée.');

// V 1.2.4.t
define('_COM_SEF_SH_DOCMAN_INSERT_CAT_ID', 'Insérer identifiant catégorie');
define('_COM_SEF_TT_SH_DOCMAN_INSERT_CAT_ID', 'Si activé, le nom de catégorie dans une URL sera toujours précédé de l&rsquo;identifiant interne de cette catégorie, ce qui est utile quand plusieurs catégories ont le même nom.');
define('_COM_SEF_SH_DOCMAN_INSERT_CATEGORIES', 'Insérer nom catégories');
define('_COM_SEF_TT_SH_DOCMAN_INSERT_CATEGORIES', 'Si réglé sur <strong>Aucune</strong>, aucun nom de catégorie ne sera inséré dans les URL sef, par exemple : <br /> monsite.com/joomla-cms.html<br />Si réglé sur <strong>La dernière seulement</strong>, le nom de la catégorie à laquelle appartient le document sera inséré dans l&rsquo;URL sef, par exemple: <br /> monsite.com/php-mysql/joomla-cms.html<br />Si réglé sur <strong>Toutes les catégories imbriquées</strong>, toute la succession de catégories auxquelles appartient le document sera insérée, par exemple : <br /> monsite.com/logiciels/cms/php-mysql/joomla-cms.html');
define('_COM_SEF_SH_FORCED_HOMEPAGE', 'URL page accueil');
define('_COM_SEF_TT_SH_FORCED_HOMEPAGE', 'Saisissez ici une URL pour la page d&rsquo;accueil. A utiliser si vous avez mis en place une &rsquo;splash page&rsquo; de type index.html, qui s&rsquo;affiche lorsque vous accédez à www.mondomaine.fr. Saisissez dans ce cas pour ce paramètre : www.mondomaine.fr/index.php (pas de / à la fin), de manière à ce que le site Joomla s&rsquo;affiche lorsque l&rsquo;on clique sur le lien Accueil du menu principal');
define('_COM_SEF_SH_INSERT_CONTENT_BLOG_NAME', 'Insérer nom blog articles');
define('_COM_SEF_TT_SH_INSERT_CONTENT_BLOG_NAME', 'Si activé, le nom de l&rsquo;élément de menu qui mène à un affichage de type blog d&rsquo;articles sera inséré dans les URL créées, afin de distinguer les liens de type blog de ceux de type Tableau');
define('_COM_SEF_SH_CONTENT_BLOG_NAME', 'Nom blogs par défaut');
define('_COM_SEF_TT_SH_CONTENT_BLOG_NAME', 'Quand le paramètre précédent est activé, vous pouvez saisir un titre ici, qui sera alors employé à la place des titres de menus. Notez bien qu&rsquo;alors ce titre est invariant, et en particulier qu&rsquo;il ne sera pas traduit.');
define('_COM_SEF_SH_MTREE_TITLE', 'Configuration Mosets Tree');
define('_COM_SEF_SH_MTREE_INSERT_NAME', 'Insérer nom MTree');
define('_COM_SEF_TT_SH_MTREE_INSERT_NAME', 'Si <strong>Activé</strong>, le titre de l&rsquo;élément de menu qui conduit à Mosets Tree sera systématiquement ajouté au début des URL sef');
define('_COM_SEF_SH_MTREE_NAME', 'Nom MTree par défaut');
define('_COM_SEF_SH_MTREE_INSERT_LISTING_ID', 'Insérer identifiant entrée');
define('_COM_SEF_TT_SH_MTREE_INSERT_LISTING_ID', 'Si activé, le titre d&rsquo;une entrée dans une URL sera toujours précédé de l&rsquo;identifiant interne de cette entrée, ce qui est utile quand plusieurs peuvent avoir le même nom.');
define('_COM_SEF_SH_MTREE_PREPEND_LISTING_ID', 'Identifiant devant nom');
define('_COM_SEF_TT_SH_MTREE_PREPEND_LISTING_ID', 'Si activé, et que le paramètre précédent l&rsquo;est aussi, l&rsquo;identifiant sera inséré AVANT le nom. Sinon, il sera inséré APRES le nom de l&rsquo;entrée.');
define('_COM_SEF_SH_MTREE_INSERT_LISTING_NAME', 'Insérer nom entrée');
define('_COM_SEF_TT_SH_MTREE_INSERT_LISTING_NAME', 'Si activé, le nom d&rsquo;une entrée sera inséré dans l&rsquo;URL sef pour tous les liens menant à une action sur cette entrée');
define('_COM_SEF_SH_IJOOMLA_NEWSP_TITLE', 'Configuration News Portal');
define('_COM_SEF_SH_INSERT_IJOOMLA_NEWSP_NAME', 'Insérer nom News Portal');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_NEWSP_NAME', 'Si <strong>Activé</strong>, le titre de l&rsquo;élément de menu qui conduit à iJoomla News Portal sera systématiquement ajouté au début des URL sef');
define('_COM_SEF_SH_IJOOMLA_NEWSP_NAME', 'Nom News Portal par défaut');
define('_COM_SEF_SH_INSERT_IJOOMLA_NEWSP_CAT_ID', 'Insérer identifiant de catégorie');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_NEWSP_CAT_ID', 'Si activé, le titre d&rsquo;une catégorie dans une URL sera toujours précédé de l&rsquo;identifiant interne de cette catégorie, ce qui est utile quand plusieurs peuvent avoir le même nom.');
define('_COM_SEF_SH_INSERT_IJOOMLA_NEWSP_SECTION_ID', 'Insérer identifiant de section');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_NEWSP_SECTION_ID', 'Si activé, le titre d&rsquo;une section dans une URL sera toujours précédé de l&rsquo;identifiant interne de cette section, ce qui est utile quand plusieurs peuvent avoir le même nom.');
define('_COM_SEF_SH_REMO_TITLE', 'Configuration Remository');
define('_COM_SEF_SH_REMO_INSERT_NAME', 'Insérer nom Remository');
define('_COM_SEF_TT_SH_REMO_INSERT_NAME', 'Si <strong>Activé</strong>, le titre de l&rsquo;élément de menu qui conduit à Remository sera systématiquement ajouté au début des URL sef');
define('_COM_SEF_SH_REMO_NAME', 'Nom Remository par défaut');
define('_COM_SEF_SH_CB_SHORT_USER_URL', 'Accès infos par URL courte');
define('_COM_SEF_TT_SH_CB_SHORT_USER_URL', 'Si <strong>Activé</strong>, l&rsquo;utilsateur pourra accéder à son profil par une URL courte, du type monsite.fr/pseudo. Bien faire attention lors de l&rsquo;activation de cette option que le pseudonyme de l&rsquo;utilisateur ne puisse pas générer de conflit avec d&rsquo;autres URL du site.');
define('_COM_SEF_NEW_HOME_META', 'Meta page accueil');
define('_COM_SEF_CONF_ERASE_HOME_META', 'Etes-vous sur vouloir effacer les balises Titre et meta pour la page d&rsquo;accueil ?');
define('_COM_SEF_SH_UPGRADE_TITLE', 'Configuration des mises à jour');
define('_COM_SEF_SH_UPGRADE_KEEP_URL', 'Conserver les URL auto');
define('_COM_SEF_TT_SH_UPGRADE_KEEP_URL', 'Si activé, les URL SEF générées automatiquement par sh404SEF seront préservées si vous désinstallez le composant. Vous pourrez ainsi les retrouver intactes après avoir installé un nouvelle version.');
define('_COM_SEF_SH_UPGRADE_KEEP_CUSTOM', 'Conserver les URL personnalisées');
define('_COM_SEF_TT_SH_UPGRADE_KEEP_CUSTOM', 'Si activé, les URL SEF personnalisées a que vous avez pu créer seront préservées si vous désinstallez le composant. Vous pourrez ainsi les retrouver intactes après avoir installé un nouvelle version.');
define('_COM_SEF_SH_UPGRADE_KEEP_META', 'Conserver balises titre et meta');
define('_COM_SEF_TT_SH_UPGRADE_KEEP_META', 'Si activé, les balises T&rsquo;itre et les Meta que vous avez pu saisir au moyen de sh404SEF seront préservées si vous désinstallez le composant. Vous pourrez ainsi les retrouver intactes après avoir installé un nouvelle version.');
define('_COM_SEF_SH_UPGRADE_KEEP_MODULES', 'Conserver paramètres des modules');
define('_COM_SEF_TT_SH_UPGRADE_KEEP_MODULES', 'Si activé, les paramètres de publication actuels des modules shCustomTags et shJoomfish seront préservés lors d&rsquo;une mise à jour de sh404SEF.');
define('_COM_SEF_IMPORT_OPEN_SEF','Importer des redirections depuis OpenSEF');
define('_COM_SEF_IMPORT_ALL','Importer des redirections');
define('_COM_SEF_EXPORT_ALL','Sauvegarder vos redirections');
define('_COM_SEF_IMPORT_EXPORT_CUSTOM','Importer/Exporter des redirections personalisées');
define('_COM_SEF_DUPLICATE_NOT_ALLOWED', 'Cette URL existe déjà alors que vous n&rsquo;autorisez pas les URL dupliquées');
define('_COM_SEF_SH_INSERT_CONTENT_MULTIPAGES_TITLE', 'Utiliser les titres d&rsquo;articles multipages');
define('_COM_SEF_TT_SH_INSERT_CONTENT_MULTIPAGES_TITLE', 'Si activé, dans le cas d&rsquo;articles multipages, sh404SEF utilisera les titres de pages insérés avec la commande {mospagebreak title=Titre_de_la_page_suivante&heading=Titre_de_la_page_precedente} à la place du numéro de page<br />Par exemple, un lien comme www.monsite.fr/documentation-utilisateur/<strong>Page-2</strong>.html sera remplacé par www.monsite.fr/documentation-utilisateur/<strong>Bien-debuter-avec-sh404SEF</strong>.html.');

// v x
define('_COM_SEF_SH_UPGRADE_KEEP_CONFIG', 'Conserver configuration');
define('_COM_SEF_TT_SH_UPGRADE_KEEP_CONFIG', 'Si activé, tous les paramètres de configuration seront préservés lors d&rsquo;une mise à jour de sh404SEF.');
define('_COM_SEF_SH_CONF_TAB_SECURITY', 'Sécurité');
define('_COM_SEF_SH_SECURITY_TITLE', 'Configuration sécurité');
define('_COM_SEF_SH_HONEYPOT_TITLE', 'Configuration Project Honey Pot');
define('_COM_SEF_SH_CONF_HONEYPOT_DOC', 'Le Projet Honey Pot est une initiative visant à protéger les sites internet des visites de robots créant des spams. Il met à disposition une base de données qui permet de comparer l\'adresse IP d\'un visiteur de votre site avec celles des robots identifiés par ailleurs. L\'utilisation de cette base de données requiert une clé d\'accés (gratuite) que vous pouvez vous procurer sur <a href="http://www.projecthoneypot.org/httpbl_configure.php">le site internet de Projet Honey Pot</a><br />(Vous devrez créer un compte avant de pouvoir obtenir votre clé d\'accés).');
define('_COM_SEF_SH_ACTIVATE_SECURITY', 'Activer fonctions sécurité');
define('_COM_SEF_TT_SH_ACTIVATE_SECURITY', 'Si activé, sh404SEF effectuera des contrôles sur le contenu des URL demandées par les visiteurs, afin de protéger le site des attaques les plus courantes.');
define('_COM_SEF_SH_LOG_ATTACKS', 'Enregistrer les attaques');
define('_COM_SEF_TT_SH_LOG_ATTACKS', 'Si activé, les attaques identifiées seront enregistrées dans un fichier journal, dans lequel figurent notamment l&rsquo;adresse IP et la requête.<br />Il existe un fichier journal par mois. Ces fichiers journaux sont situés dans le dossier <racine du site>/administrator/com_sh404sef/logs. Vous pouvez les télécharger par FTP ou utiliser un utilitaire comme JoomlaExplorer pour les visualiser.');	            
define('_COM_SEF_SH_CHECK_HONEY_POT', 'Utiliser Project Honey Pot');
define('_COM_SEF_TT_SH_CHECK_HONEY_POT', 'Si activé, l&rsquo;adresse IP des visiteurs sera contrôlée en faisant appel au service HTTP:BL fournie par le Projet Hoeny Pot. Ce service est gratuit mais requiert une inscription et l&rsquo;obtention d&rsquo;une clé.');
define('_COM_SEF_SH_HONEYPOT_KEY', 'Clé Projet Honey Pot');
define('_COM_SEF_TT_SH_HONEYPOT_KEY', 'Si vous avez activé l&rsquo;option Utiliser Project Honey Pot, vous devez obtenir sur leur site une clé d&rsquo;identification. Saisissez ici la clé qu&rsquo;ils vous enverront par email (12 caractères)');	             
define('_COM_SEF_SH_HONEYPOT_ENTRANCE_TEXT', 'Texte entrée alternative');
define('_COM_SEF_TT_SH_HONEYPOT_ENTRANCE_TEXT', 'Si l&rsquo;adresse IP d&rsquo;un visiteur est identifié par Projet Honey Pot comme douteuse, l&rsquo;accès lui sera refusé. <br />Néanmoins, s&rsquo;il s&rsquo;agit malgré tout d&rsquo;un humain et non d&rsquo;un robot, il lui est proposé de cliquer sur un lien pour accéder malgré tout au site, ce que les robots ne seront pas capables de comprendre. <br />Vous pouvez modifier le texte par défaut proposé.' );	             
define('_COM_SEF_SH_SMELLYPOT_TEXT', 'Texte piégeage');
define('_COM_SEF_TT_SH_SMELLYPOT_TEXT', 'Si l&rsquo;adresse IP d&rsquo;un visiteur est identifié par Projet Honey Pot comme douteuse, un lien est proposé vers un &rsquo;piège à robots&rsquo;, afin de les identifier et de les ajouter à la base de données du projet Honey Pot. Un message est malgré tout affiché pour les humains ne cliquent pas sur ce lien. ');
define('_COM_SEF_SH_ONLY_NUM_VARS', 'Variables numériques');
define('_COM_SEF_TT_SH_ONLY_NUM_VARS', 'Les variables placées dans cette liste (une par ligne) seront contrôlées et ne devront comporter que des chiffres');
define('_COM_SEF_SH_ONLY_ALPHA_NUM_VARS', 'Variables alpha-numériques');
define('_COM_SEF_TT_SH_ONLY_ALPHA_NUM_VARS', 'Les variables placées dans cette liste (une par ligne) seront contrôlées et ne devront comporter que des lettres et des chiffres');
define('_COM_SEF_SH_NO_PROTOCOL_VARS', 'Contrôles liens hypertextes');
define('_COM_SEF_TT_SH_NO_PROTOCOL_VARS', 'Les variables placées dans cette liste (une par ligne) seront contrôlées et ne devront pas comporter de liens hypertextes, commençant par http://, https://, ftp:// ');
define('_COM_SEF_SH_IP_WHITE_LIST', 'Liste blanche IP');
define('_COM_SEF_TT_SH_IP_WHITE_LIST', 'Toute demande de page provenant d&rsquo;une adresse IP figurant sur cette liste (une par ligne) sera acceptée (sous réserve des contrôles précédents).<br />Vous pouvez utiliser des jokers, par exemple : 192.168.0.* désignera toutes les adresses de 192.168.0.0 à 192.168.0.255.');
define('_COM_SEF_SH_IP_BLACK_LIST', 'Liste noire IP');
define('_COM_SEF_TT_SH_IP_BLACK_LIST', 'Toute demande de page provenant d&rsquo;une adresse IP figurant sur cette liste (une par ligne) sera rejetée.Vous pouvez utiliser des jokers, par exemple : 192.168.0.* désignera toutes les adresses de 192.168.0.1 à 192.168.0.255.');
define('_COM_SEF_SH_UAGENT_WHITE_LIST', 'Liste blanche UserAgent');
define('_COM_SEF_TT_SH_UAGENT_WHITE_LIST', 'Toute demande de page ayant une valeur de UserAgent figurant sur cette liste (une par ligne) sera acceptée (sous réserve des contrôles précédents)');
define('_COM_SEF_SH_UAGENT_BLACK_LIST', 'Liste noire UserAgent');
define('_COM_SEF_TT_SH_UAGENT_BLACK_LIST', 'Toute demande de page ayant une valeur de UserAgent figurant sur cette liste (une par ligne) sera rejetée');
define('_COM_SEF_SH_MONTHS_TO_KEEP_LOGS', 'Durée conservation enregistrements (mois)');
define('_COM_SEF_TT_SH_MONTHS_TO_KEEP_LOGS', 'Si l&rsquo;enregistrement des attaques est activé, vous pouvez saisir ici le nbre de mois pendant lequel il faut les conserver. Si vous saisissez 1 mois par exemple, les données du mois en cours plus celle du mois dernier seront conservées. Celles plus anciennes seront effacées.');
define('_COM_SEF_SH_ANTIFLOOD_TITLE', 'Configuration anti-flood');
define('_COM_SEF_SH_ACTIVATE_ANTIFLOOD', 'Activer l`anti-flood');
define('_COM_SEF_TT_SH_ACTIVATE_ANTIFLOOD', 'Si activé, sh404SEF vérifiera qu&rsquo;une même adresse IP ne réalise pas trop de requêtes consécutives rapprochées sur le site. Des attaques peuvent être menées par des pirates afin de rendre votre site indisponible de cette manière, en le surchargeant.');
define('_COM_SEF_SH_ANTIFLOOD_ONLY_ON_POST', 'Seulement sur les données POST (formulaires)');
define('_COM_SEF_TT_SH_ANTIFLOOD_ONLY_ON_POST', 'Si activé, le contrôle de la fréquence des requêtes depuis une même adresse IP se fera uniquement lorsque des données de type POST seront transmises, ce qui est en général le cas des formulaires, et peut donc aider à se protéger des robots spammeur de commentaires');
define('_COM_SEF_SH_ANTIFLOOD_PERIOD', 'Période de contrôle');
define('_COM_SEF_TT_SH_ANTIFLOOD_PERIOD', 'Durée (en secondes) sur laquelle le nombre de requêtes depuis une même adresse IP sera contrôlé');
define('_COM_SEF_SH_ANTIFLOOD_COUNT', 'Nbre requêtes max');
define('_COM_SEF_TT_SH_ANTIFLOOD_COUNT', 'Nombre de requêtes déclenchant un blocage de l`accès pour l`adresse IP concernée. Par exemple, la saisie de Période = 10 et de Nombre = 4 signifie que si jamais une même adresse IP effectue au moins 4 requêtes sur moins de 10 secondes consécutives, l`accés lui sera refusé (renvoie d`un code de réponse 403 et d`une page quasiment blanche). Bien sur, les autres visiteurs de votre site continueront eux à pouvoir y accéder.');
define('_COM_SEF_SH_CONF_TAB_LANGUAGES', 'Langues');
define('_COM_SEF_SH_DEFAULT', 'Par défaut');
define('_COM_SEF_SH_YES', 'Oui');
define('_COM_SEF_SH_NO', 'Non');
define('_COM_SEF_TT_SH_INSERT_LANGUAGE_CODE_PER_LANG', 'Si réglé sur Oui, le code langue iso sera inséré dans les URL générées <strong>pour cette langue</strong>. Si réglé sur Non, le code iso ne sera jamais inséré. Si réglé sur Par défaut, le code iso sera inséré, sauf pour les URL dans la langue par défaut du site.');
define('_COM_SEF_TT_SH_TRANSLATE_URL_PER_LANG', 'Si réglé sur Oui, et que votre site est multilingue, les éléments constitutifs des URLs <strong>pour cette langue</strong> seront traduits dans la langue du visiteur, tel que permis par Joomfish. Si réglé sur non, les URLs seront entièrement dans la langue par défaut du site. Si réglé sur Par défaut, les URL seront également traduites. Sans effet si votre site n&rsquo;est pas multilingue.');
define('_COM_SEF_TT_SH_INSERT_LANGUAGE_CODE_GEN', 'Si activé, le code langue iso sera inséré dans les URL générées, Vous pouvez également effectuer ci-dessous un réglage pour chaque langue.');
define('_COM_SEF_TT_SH_TRANSLATE_URL_GEN', 'Si activé, et que votre site est multilingue, les éléments constitutifs des URLs seront traduits dans la langue du visiteur, tel que permis par Joomfish. Sinon, les URLs seront entièrement dans la langue par défaut du site. Sans effet si votre site n&rsquo;est pas multilingue. Vous pouvez également effectuer ci-dessous un réglage pour chaque langue.');
define('_COM_SEF_SH_ADV_COMP_DEFAULT_STRING', 'Nom par défaut');
define('_COM_SEF_TT_SH_ADV_COMP_DEFAULT_STRING', 'Si vous entrez un nom, il sera utilisé au début de chaque URl menant à ce composant. Normalement inutile, sauf pour compatibilité avec des URL anciennes.');
define('_COM_SEF_TT_SH_NAME_BY_COMP', '.<br /> Vous pouvez également saisir un nom qui sera utilisé à la place de l&rsquo;élément de menu. Pour cela, allez dans l&rsquo;onglet : Par composant. Notez bien qu&rsquo;alors ce nom est invariant, et en particulier qu&rsquo;il ne sera pas traduit.');
define('_COM_SEF_STANDARD_ADMIN', 'Cliquez ici pour l&rsquo;interface standard (affiche paramètres principaux)');
define('_COM_SEF_ADVANCED_ADMIN', 'Cliquez ici pour l&rsquo;interface avancée (affiche tous les paramètres disponibles)');
define('_COM_SEF_SH_MULTIPLE_H1_TO_H2', 'Transformer h1 multiple en h2');
define('_COM_SEF_TT_SH_MULTIPLE_H1_TO_H2', 'Si activé, et que plusieurs balises h1 existent dans la page, elles seront transformées en balises h2. S&rsquo;il n&rsquo;y en a qu&rsquo;une, elle ne sera pas modifiée.');
define('_COM_SEF_SH_INSERT_NOFOLLOW_PDF_PRINT', 'Insérer &rsquo;nofollow&rsquo; sur liens PDF et Imprimer');
define('_COM_SEF_TT_SH_INSERT_NOFOLLOW_PDF_PRINT', 'Si Activé, des instructions rel=nofollow seront ajoutées sur les liens créés par Joomla pour imprimer ou transformer un article en PDF. Cela permet d&rsquo;éviter la duplication de contenu dans les moteurs de recherche.');
define('_COM_SEF_SH_INSERT_READMORE_PAGE_TITLE', 'Ajouter titre à Lire la suite...');
define('_COM_SEF_TT_SH_INSERT_READMORE_PAGE_TITLE', 'Si Activé, et qu&rsquo;un article comporte un lien &rsquo;Lire la suite...&rsquo;, le titre de l&rsquo;article sera inséré dans le lien affiché, pour améliorer le poids du lien dans les moteurs de recherche');

define('_COM_SEF_VM_USE_ITEMS_PER_PAGE', 'Présence sélection produits par page');
define('_COM_SEF_TT_VM_USE_ITEMS_PER_PAGE', 'Si Activé, les URL seront adaptées pour permettre un bon fonctionnement des listes de sélection du nombre de produits affichés par page. Si vous n&rsquo;utilisez pas de ces listes déroulantes, ET que les URLs de votre site sont déjà enregistrées dans les moteurs de recherche, laissez à Non, pour conserver les mêmes URL qu&rsquo;avant.');
define('_COM_SEF_SH_CHECK_POST_DATA', 'Contrôler les données dans les formulaires');
define('_COM_SEF_TT_SH_CHECK_POST_DATA', 'Si activé, les informations saisies dans les formulaires seront contrôlées. Cela peut quelqefois entraîner des blocages intempestifs si vous avez par exemple un forum dédié à Joomla, dans lequel les utilisateurs peuvent discuter de programmation Joomla ou similaire');
define('_COM_SEF_SH_SEC_STATS_TITLE', 'Statistiques de sécurité ');
define('_COM_SEF_SH_SEC_STATS_UPDATE', 'Mettre à jour décompte attaques bloquées');
define('_COM_SEF_SH_TOTAL_ATTACKS', 'Total attaques bloquées');
define('_COM_SEF_SH_TOTAL_CONFIG_VARS', 'Modif. variables mosConfig');
define('_COM_SEF_SH_TOTAL_BASE64', 'Par injection base64');
define('_COM_SEF_SH_TOTAL_SCRIPTS', 'Par injection de script');
define('_COM_SEF_SH_TOTAL_STANDARD_VARS', 'Variables standard illégales');
define('_COM_SEF_SH_TOTAL_IMG_TXT_CMD', 'Inclusion de fichier distants');
define('_COM_SEF_SH_TOTAL_IP_DENIED', 'Adresse IP interdite');
define('_COM_SEF_SH_TOTAL_USER_AGENT_DENIED', 'User agent interdit');
define('_COM_SEF_SH_TOTAL_FLOODING', 'Trop de requêtes (flooding)');
define('_COM_SEF_SH_TOTAL_PHP', 'Refusé par Project Honey Pot');
define('_COM_SEF_SH_TOTAL_PER_HOUR', ' /h');
define('_COM_SEF_SH_SEC_DEACTIVATED', 'Fonctions désactivées');
define('_COM_SEF_SH_TOTAL_PHP_USER_CLICKED', 'PHP, mais clic utilisateur');

define('_COM_SEF_SH_COM_SMF_TITLE', 'Bridge SMF');
define('_COM_SEF_SH_INSERT_SMF_NAME', 'Insérer nom forum');
define('_COM_SEF_TT_SH_INSERT_SMF_NAME', 'Si <strong>Activé</strong>, le titre de l&rsquo;élément de menu qui conduit à forum SMF sera systématiquement ajouté au début des URL sef');
define('_COM_SEF_SH_SMF_ITEMS_PER_PAGE', 'Nombre d&rsquo;éléments par page');
define('_COM_SEF_TT_SH_SMF_ITEMS_PER_PAGE', 'Nombre d&rsquo;éléments affiché sur chaque page du forume. Doit correspondre au réglage utilisé dans SMF');
define('_COM_SEF_SH_INSERT_SMF_BOARD_ID', 'Insérer identifiant forum');
define('_COM_SEF_TT_SH_INSERT_SMF_BOARD_ID', 'Si activé, l&rsquo;identifiant interne de chaque forum sera inséré dans les URL qui y méne.');
define('_COM_SEF_SH_INSERT_SMF_TOPIC_ID', 'Insérer identifiant sujet');
define('_COM_SEF_TT_SH_INSERT_SMF_TOPIC_ID', 'Si activé, l&rsquo;identifiant interne de chaque sujet sera inséré dans les URL qui y méne.');
define('_COM_SEF_SH_INSERT_SMF_USER_NAME', 'Insérer nom utilisateur');
define('_COM_SEF_TT_SH_INSERT_SMF_USER_NAME', 'Si activé, le nom des utilisateurs sera inséré dans les URL, sinon c&rsquo;est leur identifiant unique qui sera passé en paramètre. Le fait d&rsquo;employer le nom augmente sensiblement la place prise dans la base de données.');
define('_COM_SEF_SH_INSERT_SMF_USER_ID', 'Insérer id utilisateur');
define('_COM_SEF_TT_SH_INSERT_SMF_USER_ID', 'Si activé, l&rsquo;identifiant interne de chaque utilisateur sera systématiquement ajouté devant son nom.');
define('_COM_SEF_SH_PREPEND_TO_PAGE_TITLE', 'Insérer avant titre page');
define('_COM_SEF_TT_SH_PREPEND_TO_PAGE_TITLE', 'Ce texte sera systématiquement inséré avant tout titre de page');
define('_COM_SEF_SH_APPEND_TO_PAGE_TITLE', 'Ajouter après titre de page');
define('_COM_SEF_TT_SH_APPEND_TO_PAGE_TITLE', 'Ce texte sera systématiquement inséré après tout titre de page');
define('_COM_SEF_SH_DEBUG_TO_LOG_FILE', 'Activer fichier debeuguage');
define('_COM_SEF_TT_SH_DEBUG_TO_LOG_FILE', 'Si activé, sh404SEF enregistrera dans un fichier un grand nombre d&rsquo;informations pour faciliter l&rsquo;identification de problèmes (bugs) dans le logiciel. <br/>Attention: Ce fichier peut rapidement devenir très volumineux. Et cette fonction peut ralentir significativement votre site. Elle ne doit donc être activée qu&rsquo;à bon escient. Cette fonction se désactivera automatiquement au bout d&rsquo;une heure. Pour la ré-activer, mettez-là sur Non, puis à nouveau sur Oui. Le fichier se trouve dans /administrator/components/com_sh404sef/logs/ ');

define('_COM_SEF_ALIAS_LIST', 'Liste d&rsquo;alias');
define('_COM_SEF_TT_ALIAS_LIST', 'Entrez ici une liste d&rsquo;alias pour cette URL. Entrez un seul alias par ligne, sous la forme:<br/>ancienne-url.html<br/>ou<br/>mon-autre-url.php?var=12&test=15<br>sh404SEF effectuera une redirection 301 vers la nouvelle URL si une de ces anciennes adresses est demandée.');
define('_COM_SEF_HOME_ALIAS', 'Alias page accueil');
define('_COM_SEF_TT_HOME_PAGE_ALIAS_LIST', 'Entrez ici une liste d&rsquo;alias pour la page d&rsquo;accueil. Entrez un seul alias par ligne, sous la forme:<br/>ancienne-url.html<br/>ou<br/>mon-autre-url.php?var=12&test=15<br>sh404SEF effectuera une redirection 301 vers la page d&rsquo;accueil si une de ces anciennes adresses est demandée.');

define('_COM_SEF_SH_INSERT_OUTBOUND_LINKS_IMAGE', 'Insérer symbole liens externes');
define('_COM_SEF_TT_SH_INSERT_OUTBOUND_LINKS_IMAGE', 'Si activé, tous les liens vers un autre site seront signalés par un symbole graphique, afin de faciliter leur identification.');
define('_COM_SEF_SH_OUTBOUND_LINKS_IMAGE_BLACK', 'Symbole noir');
define('_COM_SEF_SH_OUTBOUND_LINKS_IMAGE_WHITE', 'Symbole blanc');
define('_COM_SEF_SH_OUTBOUND_LINKS_IMAGE', 'Couleur symbole');
define('_COM_SEF_TT_SH_OUTBOUND_LINKS_IMAGE', 'Les deux images disponibles ont un fond transparent. Choisissez l&rsquo;image noire si vos pages ont un fond blanc, et l&rsquo;image blanche si votre site a des pages à fond sombre. Les images utilisées sont /administrator/components/com_sef/images/external-white.png et external-black.png. Elles font 15x16 pixels.');

// V 1.3.3
define('_COM_SEF_DEFAULT_PARAMS_TITLE', 'Très avancé');
define('_COM_SEF_DEFAULT_PARAMS_WARNING', 'ATTENTION: ne modifiez le contenu de cette page que si vous savez ce que vous faites! En cas d&rsquo;erreur vous pouvez introduire des dysfonctionnements dans sh404SEF qu&rsquo;il vous sera ensuite très difficile de corriger.');

// V 1.0.12
define('_COM_SEF_USE_CAT_ALIAS', 'Utiliser alias de catégorie');
define('_COM_SEF_TT_USE_CAT_ALIAS', 'Si activé, sh404sef utilisera l&rsquo;alias d&rsquo;une catégorie plutôt que son nom partout où il en aura besoin dans une url');
define('_COM_SEF_USE_SEC_ALIAS', 'Utiliser alias de section');
define('_COM_SEF_TT_USE_SEC_ALIAS', 'Si activé, sh404sef utilisera l&rsquo;alias d&rsquo;une section plutôt que son nom partout où il en aura besoin dans une url');
define('_COM_SEF_USE_MENU_ALIAS', 'Utiliser alias de menu');
define('_COM_SEF_TT_USE_MENU_ALIAS', 'Si activé, sh404sef utilisera l&rsquo;alias d&rsquo;un élément de menu plutôt que son titre partout où il en aura besoin dans une url');
define('_COM_SEF_SH_ENABLE_TABLE_LESS', 'Affichage sans table');
define('_COM_SEF_TT_SH_ENABLE_TABLE_LESS', 'Si activé, sh404sef activera l&rsquo;affichage sans table (uniquement des div) quel que soit le template (gabarit) que vous utilisez. Vous ne devez pas avoir effacé le template Beez pour que cette option fonctionne. Le template Beez est installé par défaut avec Joomla.<br /><strong>ATTENTION</strong> : il vous faudra adapter les feuilles de style de votre gabarit en fonction de ce nouveau format de sortie');

// V 1.0.13
define( '_COM_SEF_JC_MODULE_CACHING_DISABLED', 'La mise en cache des urls par le module de sélection de langue de Joomfish a été désactivée!');

// V 1.5.3
define('_COM_SEF_SH_ALWAYS_APPEND_ITEMS_PER_PAGE', 'Toujours ajouter nbre elements par page');
define('_COM_SEF_TT_SH_ALWAYS_APPEND_ITEMS_PER_PAGE', 'SI activé, sh404sef ajoutere systématiquement le nombre d\'éléments par page à la fin des urls de pagination. Par exemple, .../Page-2.html deviendra .../Page2-10.html, si le réglage actuel du nombre d\'élements par page est 10. Ceci est nécessaire par exemple lorsque vous activez les listes déroulantes permettant aux utilisateurs de choisir le nombre d\'articles à afficher par page.');

define('_COM_SEF_SH_REDIRECT_CORRECT_CASE_URL', 'Redirection 301 vers la bonne casse');
define('_COM_SEF_TT_SH_REDIRECT_CORRECT_CASE_URL', 'Si activé, sh404sef effectuera une redirection 301 depuis une url entrante si elle n\'a pas la même casse que l\'url stockée dans la base de données. Par exemple, exemple.fr/Ma-page.html sera redirigée vers exemple.fr/ma-page.html, si cette dernière se trouve dans la base de données. A l\'inverse, exemple.fr/ma-page.html sera redirigée vers exemple.fr/Ma-page.html si c\'est cette dernière qui est utilisée sur votre site, et est donc stockée dans la base de données.');

// V 1.5.5
define('_COM_SEF_JOOMLA_LIVE_SITE', 'Joomla live_site');
define('_COM_SEF_TT_JOOMLA_LIVE_SITE', 'Vous devriez voir ici l\'adresse de base de votre site. Par exemple:<br />http://www.exemple.com<br/>or<br/> http://exemple.com<br />(pas de / à la fin)<br />Ce n\'est pas un réglage de sh404sef, mais de <b>Joomla</b>. Il est enregistré dans le fichier configuration.php de Joomla.<br />Joomla doit normalement auto-détecter cette adresse. Si malgré tout cette adresse est incorrecte, il faut que vous la saisissiez vous-même, directement dans le fichier configuration.php de Joomla (en général par FTP).<br/>Les symptômes liés à une mauvaise adresse de base sont: template ou images qui disparaissent, boutons qui ne fonctionnent plus, les styles css (couleurs, polices, etc) qui disparaissent,...');
define('_COM_SEF_TT_JOOMLA_LIVE_SITE_MISSING', 'ATTENTION: $live_site absent du fichier configuration.php de Joomla, ou bien il ne commence pas par "http://" ou "https://" !');
define('_COM_SEF_SH_JCL_INSERT_EVENT_ID', 'Insérer id évènement');
define('_COM_SEF_TT_SH_JCL_INSERT_EVENT_ID', 'Si activé, l\'identifiant interne d\'un évènement sera inséré dans les liens avant le titre de cet évènement, pour le rendre unique');
define('_COM_SEF_SH_JCL_INSERT_CATEGORY_ID', 'Insérer catégorie évènement');
define('_COM_SEF_TT_SH_JCL_INSERT_CATEGORY_ID', 'Si activé, quand le nom de catégorie est spécifié dans un lien, il sera précédé de l\'identifiant interne de cette catégorie afin de le rendre unique.');
define('_COM_SEF_SH_JCL_INSERT_CALENDAR_ID', 'Insérer id calendrier');
define('_COM_SEF_TT_SH_JCL_INSERT_CALENDAR_ID', 'Si activé, lorsque le nom du calendrier est spécifié dans un lien, il sera précédé de l\'identifiant interne de ce calendrier, afin de rendre le lien unique');
define('_COM_SEF_SH_JCL_INSERT_CALENDAR_NAME', 'Insérer nom calendrier');
define('_COM_SEF_TT_SH_JCL_INSERT_CALENDAR_NAME', 'Si activé, lorsqu\'un identifiant de calendrier apparait dans un lien, il sera remplacé par le nom de ce calendrier');
define('_COM_SEF_SH_JCL_INSERT_DATE', 'Insérer date');
define('_COM_SEF_TT_SH_JCL_INSERT_DATE', 'Si activé, la date correspondant à la page à afficher sera insérée au début de l\'url y menant');
define('_COM_SEF_SH_JCL_INSERT_DATE_IN_EVENT_VIEW', 'Insérer date dans vue détails');
define('_COM_SEF_TT_SH_JCL_INSERT_DATE_IN_EVENT_VIEW', 'Si activé, la date de début d\'un évènement sera insérée dans le lien menant à cet évènement');
define('_COM_SEF_SH_JCL_TITLE', 'Configuration JCal Pro');
define('_COM_SEF_SH_PAGE_TITLE_TITLE', 'Configuration titre de page');
define('_COM_SEF_SH_CONTENT_TITLE_TITLE', 'Configuration titre de page pour les articles');
define('_COM_SEF_SH_CONTENT_TITLE_SHOW_SECTION', 'Insérer section');
define('_COM_SEF_TT_CONTENT_TITLE_SHOW_SECTION', 'Si activé, le titre de la section à laquelle appartient l\'article sera inséré dans le titre de page');
define('_COM_SEF_SH_CONTENT_TITLE_SHOW_CAT', 'Insérer catégory');
define('_COM_SEF_TT_CONTENT_TITLE_SHOW_CAT', 'Si activé, le titre de la catégory à laquelle appartient l\'article sera inséré dans le titre de page');
define('_COM_SEF_SH_CONTENT_TITLE_USE_ALIAS', 'Utiliser l\'alias d\'article');
define('_COM_SEF_TT_CONTENT_TITLE_USE_ALIAS', 'Si activé, l\'alias du titre d\'article sera utilisé à la place de son titre pour déterminer le titre de page');
define('_COM_SEF_SH_CONTENT_TITLE_USE_CAT_ALIAS', 'Utiliser l\'alias de catégorie');
define('_COM_SEF_TT_CONTENT_TITLE_USE_CAT_ALIAS', 'Si activé, l\'alias du titre de catégorie sera utilisé à la place de son titre pour déterminer le titre de page');
define('_COM_SEF_SH_CONTENT_TITLE_USE_SEC_ALIAS', 'Utiliser l\'alias de section');
define('_COM_SEF_TT_CONTENT_TITLE_USE_SEC_ALIAS', 'Si activé, l\'alias du titre de section sera utilisé à la place de son titre pour déterminer le titre de page');
define('_COM_SEF_SH_PAGE_TITLE_SEPARATOR', 'Séparateur');
define('_COM_SEF_TT_SH_PAGE_TITLE_SEPARATOR', 'Saisissez ici une chaine de caractères qui sera utilisée pour séparer les éléments du titre de page,s\'il y en a plus d\un. Vaut par défaut le caractère |, entouré d\'un espace');

// V 1.5.7
define('_COM_SEF_DISPLAY_DUPLICATE_URLS_TITLE', 'Url dupliquées');
define('_COM_SEF_DISPLAY_DUPLICATE_URLS_NOT', 'Montrer l\'url principale');
define('_COM_SEF_DISPLAY_DUPLICATE_URLS', 'Montrer principale et dupliquées');
define('_COM_SEF_SH_INSERT_ARTICLE_ID_TITLE', 'Insérer identifiant article');
define('_COM_SEF_TT_SH_INSERT_ARTICLE_ID_TITLE', 'Si activé, l\'identifiant interne d\'un article sera ajouté à la fin des urls, pour s\'assurer que tous les articles sont accessibles même dans le cas où plusieurs articles ont exactement le même titre, ou génère la même url (après que le titre ait été nettoyé des caractères invalides, etc). Cet identifiant n\'aucune valeur sur le plan de l\'optimisation pour les moteurs de recherche, et vous devriez plutôt essayer de vous assurer que tous vos artciles ont des titres distincts. Si ce n\'est pas possible - par exemple si ce n\'est pas vous qui les saisissez, ce réglage peut malgré tout vous aider à être sur que tous les articles soient accessibles individuellement, au prix d\'une moins bonne optimisation des urls');

// V 1.5.8

define('_COM_SEF_SH_JS_TITLE', 'Configuration JomSocial ');
define('_COM_SEF_SH_JS_INSERT_NAME', 'Insérer nom JomSocial');
define('_COM_SEF_TT_SH_JS_INSERT_NAME', 'If set to <strong>Yes</strong>, the menu element title leading to JomSocial main page will be prepended to all JomSocial SEF URL');
define('_COM_SEF_SH_JS_INSERT_USER_NAME', 'Insérer le pseudo');
define('_COM_SEF_TT_SH_JS_INSERT_USER_NAME', 'If set to <strong>Yes</strong>, user name will be inserted into SEF URLs. <strong>WARNING</strong>: this can lead to substantial increase in database size, and can slow down site, if you have many registered users.');
define('_COM_SEF_SH_JS_INSERT_USER_FULL_NAME', 'Insérer nom complet');
define('_COM_SEF_TT_SH_JS_INSERT_USER_FULL_NAME', 'If set to <strong>Yes</strong>, user full name will be inserted into SEF URLs. <strong>WARNING</strong>: this can lead to substantial increase in database size, and can slow down site, if you have many registered users.');
define('_COM_SEF_SH_JS_INSERT_GROUP_CATEGORY', 'Insérer catégorie du groupe');
define('_COM_SEF_TT_SH_JS_INSERT_GROUP_CATEGORY', 'If set to <strong>Yes</strong>, a users group\'s category will be inserted into SEF URLs where the group name is used.');
define('_COM_SEF_SH_JS_INSERT_GROUP_CATEGORY_ID', 'Insérer ID catégorie de groupe');
define('_COM_SEF_TT_SH_JS_INSERT_GROUP_CATEGORY_ID', 'If set to <strong>Yes</strong>, a users group category ID will be prepended to the category name <strong>when previous option is also set to Yes</strong>, just in case two categories have the same name.');
define('_COM_SEF_SH_JS_INSERT_GROUP_ID', 'Insérer ID de groupe');
define('_COM_SEF_TT_SH_JS_INSERT_GROUP_ID', 'If set to <strong>Yes</strong>, a users group ID will be prepended to the group name, just in case two groups have the same name.');
define('_COM_SEF_SH_JS_INSERT_GROUP_BULLETIN_ID', 'Insérer ID de bulletin');
define('_COM_SEF_TT_SH_JS_INSERT_GROUP_BULLETIN_ID', 'If set to <strong>Yes</strong>, a users group bulletin ID will be prepended to the bulletin name, just in case two bulletins have the same name.');
define('_COM_SEF_SH_JS_INSERT_DISCUSSION_ID', 'Insérer ID de fil de discussion');
define('_COM_SEF_TT_SH_JS_INSERT_DISCUSSION_ID', 'If set to <strong>Yes</strong>, a users group discussion ID will be prepended to the discussion name, just in case two discussions have the same name.');
define('_COM_SEF_SH_JS_INSERT_MESSAGE_ID', 'Insérer ID de message');
define('_COM_SEF_TT_SH_JS_INSERT_MESSAGE_ID', 'If set to <strong>Yes</strong>, a message ID will be prepended to the message name, just in case two messages have the same subject.');
define('_COM_SEF_SH_JS_INSERT_PHOTO_ALBUM', 'Insérer nom d\'album');
define('_COM_SEF_TT_SH_JS_INSERT_PHOTO_ALBUM', 'If set to <strong>Yes</strong>, the name of the album it belongs to will be inserted into SEF URLs of a photo or set of photos.');
define('_COM_SEF_SH_JS_INSERT_PHOTO_ALBUM_ID', 'Insérer ID d\'album');
define('_COM_SEF_TT_SH_JS_INSERT_PHOTO_ALBUM_ID', 'If set to <strong>Yes</strong>, an album ID will be prepended to the album name, just in case two albums have the same subject.');
define('_COM_SEF_SH_JS_INSERT_PHOTO_ID', 'Insérer ID de photo');
define('_COM_SEF_TT_SH_JS_INSERT_PHOTO_ID', 'If set to <strong>Yes</strong>, a photo ID will be prepended to the photo name, just in case two photos have the same subject.');
define('_COM_SEF_SH_JS_INSERT_VIDEO_CAT', 'Insérer nom de catégorie vidéo');
define('_COM_SEF_TT_SH_JS_INSERT_VIDEO_CAT', 'If set to <strong>Yes</strong>, the name of the category it belongs to will be inserted into SEF URLs of a video or set of videos.');
define('_COM_SEF_SH_JS_INSERT_VIDEO_CAT_ID', 'Insérer ID de catégorie vidéo');
define('_COM_SEF_TT_SH_JS_INSERT_VIDEO_CAT_ID', 'If set to <strong>Yes</strong>, a video category ID will be prepended to the category name, just in case two categories have the same subject.');
define('_COM_SEF_SH_JS_INSERT_VIDEO_ID', 'Insérer ID de vidéo');
define('_COM_SEF_TT_SH_JS_INSERT_VIDEO_ID', 'If set to <strong>Yes</strong>, a video ID will be prepended to the video name, just in case two videos have the same subject.');
define('_COM_SEF_SH_FB_INSERT_USERNAME', 'Insérer le nom d\'utilisateur');
define('_COM_SEF_TT_SH_FB_INSERT_USERNAME', 'Si activé, le nom d\'utilisateur sera inséré dans les URL SEF pour ses messages ou son profil.');
define('_COM_SEF_SH_FB_INSERT_USER_ID', 'Insérer ID utilisateur');
define('_COM_SEF_TT_SH_FB_INSERT_USER_ID', 'Si activé, le nom d\'utilisateur dans une URL sera toujours précédé de l\'identifiant interne de cet utilisateur, au cas où deux d\'entre eux aurait le même pseudo.');
define('_COM_SEF_SH_PAGE_NOT_FOUND_ITEMID', 'Itemid to use for 404 page');
define('_COM_SEF_TT_SH_PAGE_NOT_FOUND_ITEMID', 'The value entered here, if non zero, will be used to display the 404 page. Joomla will use the Itemid to decide which template and modules to display. Itemid represents a menu item, so you can look up Itemids in your menus list.');

//define('', '');