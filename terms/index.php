<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/languageHandler.php";

if (isset($_COOKIE['token']))
{
    $user = strtok($_COOKIE['token'], '_');
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token']))
    {
    }
    else
    {
        $user = "none";
    }
}
else
{
    $user = "none";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_terms_title ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php

        if ($user != "none")
        {
            if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/dark") == "True")
            {
                    echo("<link rel=\"stylesheet\" href=\"/resources/style/dark.css\" />"); 
            }
        }

        ?>
    </head>
    <body class="abody">
        <?php 
        
            if ($user == "none") {
                include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/headerWhenLoggedOut.php";
            } else {
                include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header.php";
            }
        
        ?>
        <div class="header_escape">
            <?php
            
            if ($lang == "fr") {
                echo("<h1>Conditions générales d'utilisation de PinPages</h1>
            <p>Les conditions d'utilisation suivantes s'appliquent entièrement au service PinPages durant votre utilisation de ce dernier. Lors de votre utilisation du service, vous souscrivez à un contrat entre l'organisme qui dirige PinPages (Minteck Projects) et vous.</p>
            <p>Vous êtes priés de bien vouloir lire et aggréer à ces conditions d'utilisation avant toute utilisation du service PinPages.</p>
            <h2>Utilisation commerciale</h2>
            <p>L'utilisation de PinPages dans un but commercial est strictement interdit, sauf sous autorisation expresse de la part de Minteck Projects.</p>
            <p>À l'inverse, l'utilisation de PinPages à but éducatif et dans les établissements scolaires est entièrement autorisée, à condition que les élèves soient agés de l'age minimal requis pour un compte PinPages.</p>
            <h2>Publicité</h2>
            <p>L'utilisation de PinPages exclusivement à des fins publicitaires est strictement interdite, et constituera une suspension du compte utilisateur concerné.</p>
            <p>Au contraire, la publicité est autorisée pour les partenaires PinPages et/ou Minteck Projects.</p>
            <h2>Droits d'auteurs</h2>
            <p>Conformément à l'article 17 voté par le parlement européen en 2018, il vous est interdit de poster tout contenu dont vous n'êtes pas l'auteur, excepté s'il est sous licence libre ou dans le domaine public.</p>
            <p>PinPages est localisé en France. De ce fait, les règles concernant les droits d'auteurs en France s'appliquent ici. Pour utiliser un texte provenant d'un auteur qui est décédé, il doit être décédé depuis au moins 70 ans, conformément au Code de la Propriété Intellectuelle en France.</p>
            <h2>Âge minimum</h2>
            <p>PinPages se doit d'être un réseau social pour tous, mais il peut conduire à plusieurs problèmes (retards éducationnels, troubles de vie en société, ...) chez les jeunes enfants.</p>
            <p>Pour nous assurer que cela ne se produira pas, PinPages est interdit aux enfants de moins de 12 ans. En dessous de cet âge, l'accès à PinPages ne se fait que sous la surveillance du responsable légal de l'enfant.</p>
            <p>Via l'option de signalement d'un utilisateur de PinPages, vous pouvez signaler le compte d'un enfant de moins de 12 ans. Si nous jugeons cela juste, nous suspendrons le compte jusqu'à preuve du contraire.</p>
            <h2>Contenus interdits</h2>
            <p>PinPages doit être un réseau social pour tous, et nous nous devons d'interdire certains de ces contenus.</p>
            <p>La publication d'un des contenus interdits encourt à des sanctions pouvant aller de la suppression du contenu à la suspension du compte concerné.</p>
            <h3>Contenu sexuellement explicite</h3>
            Cela inclut :
            <ul>
                <li>Contenu pornographique</li>
                <li>Contenu contenant des images sexuelles</li>
                <li>Illustrations d'organes génitaux</li>
            </ul>
            <h3>Contenu insultant</h3>
            Cela inclut le contenu insultant envers :
            <ul>
                <li>L'Équipe PinPages</li>
                <li>Une ou plusieurs personnes</li>
                <li>Un organisme, une entreprise ou une association</li>
                <li>Un pays</li>
                <li>Une personne politique</li>
                <li>Un(e) modérateur/rice de PinPages</li>
                <li>Les développeurs de PinPages</li>
            </ul>
            <h3>Autres contenus interdits</h3>
            <ul>
                <li>Contenu raciste</li>
                <li>Contenu antisémite</li>
                <li>Contenu homophobe</li>
                <li>Insultes vis-à-vis du physique ou du caractère d'une personne</li>
                <li>Harcèlement moral</li>
            </ul>
            <h3>Note</h3>
            <p>Depuis sa version 19.07, PinPages vient avec un blocage automatique des insultes connues dans la plupart des langues que supporte PinPages.</p>
            <p>Vous pouvez essayer vous-même...</p>
            <h2>Accès à PinPages</h2>
            <p>L'accès à PinPages n'est autorisé que via les applications déployées par Minteck Projects et un navigateur Web standard.</p>
            Cela exclut donc :
            <ul>
                <li>Les clients modifiés ou de tierce partie</li>
                <li>Les versions non supportés des clients officiels</li>
                <li>Un navigateur ou une extension modifiant l'apparence du site</li>
                <li>L'utilisation directe de l'interface de programmation de l'application (API)</li>
            </ul>
            <h2>Traçage</h2>
            <p>Pour des questions de sécurité, nous récupérons votre adresse Internet, qui inclut votre localisation et votre agent utilisateur lorsque vous vous connectez à PinPages.</p>
            <p>Ces informations pourront servir de preuves contre vous en cas de litige. Elles sont nettoyés régulièrement.</p>
            <h2>Entrave au bon fonctionnement de PinPages</h2>
            <h3>Dénis de service</h3>
            <p>Les attaques par dénis de service (anglais : <i>denial of service</i>), DDOS sont strictement interdites.</p>
            <p>Cela constitue une entrave au fonctionnement d'un service (selon la loi) et peut conduire à des poursuites judiciaires par Minteck Projects et l'hébergeur de PinPages (ici <a href=\"https://alwaysdata.net\">AlwaysData</a>).</p>
            <h3>Tentative d'intrusion dans un compte</h3>
            <p>Depuis sa version 19.06.2, PinPages bloque automatiquement votre adresse Internet pendant 1 heure si vous échouez plus de 5 fois à l'entrée d'un mot de passe dans l'heure courante.</p>
            <p>Tenter de s'introduire dans un compte qui n'est pas le sien, et d'outrepasser les sécuritées mises en place par l'Équipe PinPages est strictement interdit et peut conduire à un bannissement définitif de votre adresse Internet.</p>
            <h3>Tentative d'intrusion dans les serveurs de PinPages</h3>
            <p>S'introduire dans un des serveurs de PinPages sans autorisation, pour une quelconque raison, est strictement interdit.</p>
            <p>Cela pourrait engranger vol de données personnelles, mots de passes, usurpation d'identité, ...</p>
            <p>Nous faisons de notre mieux pour que cela n'arrive jamais, même si nous ne sommes jamais à l'abri d'un quelconque risque d'intrusion.</p>
            <p>S'introduire dans un des serveurs de PinPages constituerait un manquement aux lois et peut conduire à des poursuites judiciaires. Vous serez obligatoirement bloqués par l'hébergeur du serveur concerné.</p>
            <h2>Changement d'adresse Internet</h2>
            <p>Il vous est interdit de changer d'adresse Internet après avoir reçu un bannissement, même temporaire, en utilisant par exemple un réseau privé virtuel (VPN ou RPV) ou un serveur proxy.</p>
            <p>Cela peut conduire à un bannissement définitif de votre matériel par les administrateurs de PinPages, ce qui vous empêchera d'accéder à PinPages, peu importe quelle est votre adresse Internet.</p>
            <h2>Liens douteux</h2>
            <p>Sur PinPages, vous pouvez insérer un lien sous vos posts, pour par exemple rediriger l'utilisateur vers une page donnant une description plus détaillée de ce que vous présentez.</p>
            <p>Toutefois, l'utilisation du système de lien aux fins suivantes sont strictement interdites :</p>
            <ul>
                <li>Logiciels malveillants ou virus</li>
                <li>Traçage de l'utilisateur</li>
                <li>Introduction dans un compte PinPages ou autre</li>
                <li>Hameçonnage</li>
                <li>Arnaques</li>
            </ul>
            <h2>Légalité</h2>
            <p>PinPages doit être un réseau social qui respecte la loi, et nous y faisont le plus attention possible. Vous aussi, jouez un rôle dans la légalité de PinPages</p>
            <p>De ce fait, il est strictement interdit d'utiliser PinPages à des fins illégales.</p>
            <p>Toute utilisation à des fins illégales de PinPages constituera une suspension définitive du compte et un signalement aux autorités locales.</p>");
                } else {
                    echo("<h1>PinPages terms of use</h1>
                    <p>The following terms of use applies to all PinPages service during your use of it. When using PinPages, you subscribe to a contract between the organization that manages PinPages (Minteck Projects) and you.</p>
                    <p>You are kindly requested to read and accept these terms of use before using the PinPages service.</p>
                    <h2>Commercial use</h2>
                    <p>Using PinPages for a commercial purpose is strictly prohibited, except with the agreement of Minteck Projects.</p>
                    <p>Conversely, using PinPages for educationnal purposes and in schools is entirely allowed, provided that students are older than the minimal required age for a PinPages account.</p>
                    <h2>Advertisment</h2>
                    <p>Using PinPages only for advertisment purposes is strictly prohibited, and will result in an account suspension.</p>
                    <p>Conversely, advertising is allowed for PinPages and/or Minteck Projects partnairs.</p>
                    <h2>Copyrights</h2>
                    <p>In accordance with the Article 17 voted by the European Parliament in 2018, you cannot post anything you are not the owner, excepted if it's released using a free license, or in the public domain.</p>
                    <p>PinPages is located in France. Thereby, rules about copyright in France applies here. To use a text from a dead author, it must be dead from at least 70 years, in accordance to the Intellectual Property Code in France.</p>
                    <h2>Minimal age</h2>
                    <p>PinPages must be a social network for everyone, but can result some problems (education eaters, disorders in society, ...) among young children.</p>
                    <p>To be sure that will never happen, PinPages is prohibed for children younger than 12 years old. Below this age, access to PinPages can be done only with adult supervisation.</p>
                    <p>Using PinPages's user report feature, you can report the account of a children younger than 12 years old. If we judge that right, we will suspend the account until proof of the opposite.</p>
                    <h2>Prohibited content</h2>
                    <p>PinPages needs to be a social network for everything, and we need to prohibit some of those content.</p>
                    <p>Publishing prohibited content may incur to sanctions, from the removal of the content to the account suspension.</p>
                    <h3>Sexually explicit content</h3>
                    This includes:
                    <ul>
                        <li>Pornographic content</li>
                        <li>Content containing sexual pictures</li>
                        <li>Génital organs illustrations</li>
                    </ul>
                    <h3>Insulting content</h3>
                    This includes content towards:
                    <ul>
                        <li>the PinPages Team</li>
                        <li>one person or more</li>
                        <li>an organization, an enterprise or an association</li>
                        <li>a country</li>
                        <li>a politician</li>
                        <li>a PinPages moderator</li>
                        <li>PinPages developpers</li>
                    </ul>
                    <h3>Other prohibited content</h3>
                    <ul>
                        <li>Racist content</li>
                        <li>Anti-semite content</li>
                        <li>Homophobic content</li>
                        <li>Insults regarding the physical or the character of someone</li>
                        <li>Harassment</li>
                    </ul>
                    <h3>Note</h3>
                    <p>Since PinPages 19.07, insults are automaticaly blocked on every language that PinPages supports.</p>
                    <p>You may try by yourself...</p>
                    <h2>PinPages Access</h2>
                    <p>The access to PinPages is allowed only using apps deployed by Minteck Projects and a common web browser.</p>
                    By the way, this excludes:
                    <ul>
                        <li>Modified or third party client</li>
                        <li>Deprecated versions of official clients</li>
                        <li>A browser or extension changing the site appearance</li>
                        <li>Direct use of the application programming interface (API)</li>
                    </ul>
                    <h2>Tracing</h2>
                    <p>For security purposes, we may collect your Internet address, which includes your location and your user agent when you connect to PinPages.</p>
                    <p>This data may serve as evidence against you in case of dispute. They are cleanned-up periodically.</p>
                    <h2>Hinder the proper functioning of PinPages</h2>
                    <h3>Denial of service</h3>
                    <p>Denial of service attacks, commonly DDOS, are strictly prohibited.</p>
                    <p>This is an obstacle to the proper functioning of a service (according the law) and can lead to legal proceedings by Minteck Projects and the PinPages hosting (here <a href=\"https://alwaysdata.net\">AlwaysData</a>).</p>
                    <h3>Attempt to steal an account</h3>
                    <p>Since PinPages 19.06.2, it automatically blocks your Internet address for 1 hour if you fail more than 5 time while entering a password in the current hour.</p>
                    <p>Try to go in an account other than yours, and to bypass securities made by the PinPages Team is strictly prohibited and may lead to a lifetime Internet address ban.</p>
                    <h3>Attempt to infiltrate PinPages servers</h3>
                    <p>Infiltrating one of the PinPages servers without permission, no matter the reason, is strictly prohibited.</p>
                    <p>This may lead to personal data theft, passwords theft, identity usurpation, ...</p>
                    <p>We do our best for that never happen, even if we are never shelter from any infiltration risk.</p>
                    <p>Infiltrating one of the PinPages servers would be a breach of laws and may lead to legal proceedings. You will be blocked by the hosting of the concernated server.</p>
                    <h2>Internet address change</h2>
                    <p>You are unallowed to change your Internet address after you got banned, even temporarily, by using for example a virtual private network (VPN) or a proxy server.</p>
                    <p>This may lead to lifetime ban of your hardware by PinPages administrators, which will prevent you from accessing PinPages, no matter what is your Internet address.</p>
                    <h2>Mysterious links</h2>
                    <p>On PinPages, you can insert links at the bottom of your posts, to for example redirect the user to a page giving a better description of what you want to say.</p>
                    <p>However, using link system for this purposes is entirely prohibited:</p>
                    <ul>
                        <li>Harmful software and viruses</li>
                        <li>User tracking</li>
                        <li>Steal a PinPages account or another account</li>
                        <li>Physhing</li>
                        <li>Scams</li>
                    </ul>
                    <h2>Legality</h2>
                    <p>PinPages needs to be a social network respecting the laws, and we take care most of that. You too, play a role in PinPages's legality</p>
                    <p>Thereby, it's strictly prohibited to use PinPages for illegal purposes.</p>
                    <p>Any use of PinPages for illegal purposes will lead to lifetime account suspension and a report to local authorities.</p>
                </div>");
                }

            ?>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
    <script src="index.js"></script>
</html>