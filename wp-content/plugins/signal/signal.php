<?php
/*
Plugin Name: Signal
Plugin URI: https://github.com/OUHARRI/signal.git
Description: Plugin de signal personnalisé pour WordPress
Version: 1.0
Author: ouharri outman
Author URI: https://github.com/ouharri
*/
// Fonction d'activation du plugin
function mon_plugin_activation()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'signal';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nom varchar(255) NOT NULL,
        prenom varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        type_signal varchar(255) NOT NULL,
        raison_signal varchar(255) NOT NULL,
        commentaire varchar(255) NOT NULL,
        date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'mon_plugin_activation');

// Fonction de désactivation du plugin
function mon_plugin_desactivation()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'signal';

    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

register_deactivation_hook(__FILE__, 'mon_plugin_desactivation');

function signal_add_menu_page()
{
    add_menu_page(
        __('Signal', 'textdomain'),
        'Signal',
        'manage_options',
        'Signal',
        '',
        'dashicons-admin-plugins',
        6
    );
    add_submenu_page(
        'Signal',
        __('Books Shortcode Reference', 'textdomain'),
        __('Shortcode Reference', 'textdomain'),
        'manage_options',
        'Signal',
        'Signal_callback'
    );
}
add_action('admin_menu', 'signal_add_menu_page');

function Signal_callback()
{
?>
    <style>
        .form {
            margin-top: 10rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 50%;
            margin: 0 25%;
            justify-content: center;
        }

        form div {
            display: flex;
            flex-direction: row;
            justify-content: start;
        }

        form div label,
        form div input {
            cursor: pointer;
        }

        .Submit {
            background-color: #0d6efd;
            color: black;
            font-size: 1rem;
            width: 6rem;
            display: flex;
            justify-content: center;
            border: 1px solid;
            border-radius: 7px;
            cursor: pointer;
        }

        .Submit:hover {
            color: aliceblue;
        }
    </style>
    <form class="form" id="form">
        <div>
            <input type="radio" name="nom" id="nom">
            <label class="labelForm" for="nom">nom:</label>
        </div>
        <div>
            <input type="radio" name="prenom" id="prenom">
            <label class="labelForm" for="prenom">prenom:</label>
        </div>
        <div>
            <input type="radio" name="email" id="email">
            <label class="labelForm" for="email">Email:</label>
        </div>
        <div>
            <input type="radio" name="type_signal" id="type_signal">
            <label class="labelForm" for="type_signal">le type de signal:</label>
        </div>
        <div>
            <input type="radio" name="raison_signal" id="raison_signal">
            <label class="labelForm" for="raison_signal">le raison de votre signal:</label>
        </div>
        <div>
            <input type="radio" name="commentaire" id="commentaire">
            <label class="labelForm" for="commentaire">un commentaire:</label>
        </div>
        <div>
            <input class="Submit" type="submit" value="Save">
        </div>
    </form>
    <script>
        var form = document.getElementById('form')
        form.addEventListener('submit', event => {
            event.preventDefault();
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);
            if (data.nom == 'on') {
                var nomInput = `<div>
                                    <label for="nom">nom:</label>
                                    <input type="text" name="nom" id="nom">
                                </div>`
            } else {
                var nomInput = `<input type="hidden" value=' ' name="nom" id="nom">`
            }
            if (data.prenom == 'on') {
                var prenomInput = `<div>
                                    <label for="prenom">prenom:</label>
                                    <input type="text" name="prenom" id="prenom">
                                </div>`
            } else {
                var prenomInput = `<input type="hidden" value=' ' name="prenom" id="prenom">`
            }
            if (data.email == 'on') {
                var emailInput = `<div>
                                    <label for="email">email:</label>
                                    <input type="email" name="email" id="email">
                                </div>`
            } else {
                var emailInput = `<input type="hidden" value=' ' name="email" id="email">`
            }
            if (data.type_signal == 'on') {
                var typeInput = `<div>
                                    <label for="type_signal">type de signal:</label>
                                    <select name="type_signal" id="type_signal">
                                        <option value="type 1">type 1</option>
                                        <option value="type 2">type 2</option>
                                        <option value="type 3">type 3</option>
                                    </select>
                                </div>`
            } else {
                var typeInput = `<input type="hidden" value=' ' name="type_signal" id="type_signal">`
            }
            if (data.raison_signal == 'on') {
                var raisonInput = `<div>
                                    <label for="raison_signal">raison de signal:</label>
                                    <select name="raison_signal" id="raison_signal">
                                        <option value="raison 1">raison 1</option>
                                        <option value="raison 2">raison 2</option>
                                        <option value="raison 3">raison 3</option>
                                    </select>
                                </div>`
            } else {
                var raisonInput = `<input type="hidden" value=' ' name="raison_signal" id="raison_signal">`
            }
            if (data.commentaire == 'on') {
                var commentaireInput = `<div>
                                    <label for="commentaire">commentaire:</label>
                                    <textarea style="resize:none" name="commentaire" id="commentaire" cols="30" rows="10"></textarea>
                                </div>`
            } else {
                var commentaireInput = `<input type="hidden" value=' ' name="commentaire" id="commentaire">`
            }
            var formSelected = `<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                                    ${nomInput}
                                    ${prenomInput}
                                    ${emailInput}
                                    ${typeInput}
                                    ${raisonInput}
                                    ${commentaireInput}
                                    <div>
                                        <input type="hidden" name="action" value="mon_plugin_register">
                                        <input class="Submit" type="submit" value="Envoyer">
                                    </div>
                                </form>`
            localStorage.setItem("formSelected", formSelected)
        })
    </script>
<?php
}
function mon_plugin_shortcode_signal()
{
    ob_start();
?>
    <style>
        p form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 50%;
            margin: 0 25%;
        }

        p form div {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .Submit {
            background-color: #0d6efd;
            color: black;
            font-size: 1rem;
            width: 6rem;
            display: flex;
            justify-content: center;
            border: 1px solid;
            border-radius: 7px;
            cursor: pointer;
        }

        .Submit:hover {
            color: aliceblue;
        }
    </style>
    <p id="p"></p>
    <script>
        var p = document.getElementById('p')
        var formSelected = localStorage.getItem("formSelected")
        p.innerHTML = formSelected
    </script>
<?php
    return ob_get_clean();
}
add_shortcode('mon_plugin_form_signal', 'mon_plugin_shortcode_signal');
function mon_plugin_register()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'signal';


    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $type_signal = $_POST['type_signal'];
    $raison_signal = $_POST['raison_signal'];
    $commentaire = $_POST['commentaire'];

    $wpdb->insert(
        $table_name,
        array(
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'type_signal' => $type_signal,
            'raison_signal' => $raison_signal,
            'commentaire' => $commentaire
        )
    );

    wp_redirect(home_url(''));
    exit;
}
add_action('admin_post_mon_plugin_register', 'mon_plugin_register');
function affiche_signal_add_menu_page()
{
    add_menu_page(
        __('affiche_Signal', 'textdomain'),
        'affiche_Signal',
        'manage_options',
        'affiche_Signal',
        '',
        'dashicons-admin-home',
        6
    );
    add_submenu_page(
        'affiche_Signal',
        __('Books Shortcode Reference', 'textdomain'),
        __('Shortcode Reference', 'textdomain'),
        'manage_options',
        'affiche_Signal',
        'affiche_Signal_callback'
    );
}
add_action('admin_menu', 'affiche_signal_add_menu_page');

function affiche_Signal_callback()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'signal';

    $results = $wpdb->get_results("SELECT * FROM $table_name");
?>
    <table>
        <tr>
            <td>nom</td>
            <td>prenom</td>
            <td>email</td>
            <td>type_signal</td>
            <td>raison_signal</td>
            <td>commentaire</td>
            <td>date</td>
        </tr>
        <?php foreach ($results as $result) { ?>
            <tr>
                <td><?= $result->nom ?></td>
                <td><?= $result->prenom ?></td>
                <td><?= $result->email ?></td>
                <td><?= $result->type_signal ?></td>
                <td><?= $result->raison_signal ?></td>
                <td><?= $result->commentaire ?></td>
                <td><?= $result->date ?></td>
            </tr>
        <?php } ?>
    </table>
<?php
}
?>
