<?php

use JetBrains\PhpStorm\NoReturn;

/*
Plugin Name: Signal
Plugin URI: https://github.com/OUHARRI/signal
Description: Plugin de signal personnalisé pour WordPress
Version: 1.0
Author: ouharri
Author URI: https://github.com/ouharri
*/

function activationSignal(): void
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

register_activation_hook(__FILE__, 'activationSignal');

function desactivationSignal(): void
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'signal';

    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

register_deactivation_hook(__FILE__, 'desactivationSignal');

function addMenuPageSignal(): void
{
    add_menu_page(
        __('Signal', 'textdomain'),
        'Signal',
        'manage_options',
        'Signal',
        '',
        'dashicons-forms',
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

add_action('admin_menu', 'addMenuPageSignal');

function Signal_callback(): void
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>

    <div class="flex flex-col justify-center">
        <form class="form rounded-lg border-2 border-gray-600 flex flex-col justify-center space-y-3 p-11 m-11"
              id="form" style="padding-left: 60px;padding-top: 10px;padding-bottom: 20px">
            <div class="flex flex-col">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Signal Form :</h3>
                <p class="text-2xl text-gray-500 dark:text-gray-100">choose input for signal Form</p>
            </div>
            <div class="flex" style="display: flex">
                <div class="flex items-center h-5">
                    <input name="nom" id="nom" aria-describedby="helper-checkbox-text" type="checkbox"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </div>
                <div class="ml-2 text-sm flex flex-col">
                    <label for="nom" class="font-medium text-gray-900 dark:text-gray-300">name</label>
                    <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">Add user
                        name</p>
                </div>
            </div>
            <div class="flex" style="display: flex">
                <div class="flex items-center h-5">
                    <input name="prenom" id="prenom" aria-describedby="helper-checkbox-text" type="checkbox"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </div>
                <div class="ml-2 text-sm flex flex-col">
                    <label for="prenom" class="font-medium text-gray-900 dark:text-gray-300">prenom</label>
                    <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">Add user
                        last name</p>
                </div>
            </div>
            <div class="flex" style="display: flex">
                <div class="flex items-center h-5">
                    <input name="email" id="email" aria-describedby="helper-checkbox-text" type="checkbox"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </div>
                <div class="ml-2 text-sm flex flex-col">
                    <label for="email" class="font-medium text-gray-900 dark:text-gray-300">email</label>
                    <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">Add user
                        email</p>
                </div>
            </div>
            <div class="flex" style="display: flex">
                <div class="flex items-center h-5">
                    <input name="type_signal" id="type_signal" aria-describedby="helper-checkbox-text" type="checkbox"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </div>
                <div class="ml-2 text-sm flex flex-col">
                    <label for="type_signal" class="font-medium text-gray-900 dark:text-gray-300">signal type</label>
                    <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">Add type
                        of signal for user</p>
                </div>
            </div>
            <div class="flex" style="display: flex">
                <div class="flex items-center h-5">
                    <input name="raison_signal" id="raison_signal" aria-describedby="helper-checkbox-text"
                           type="checkbox"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </div>
                <div class="ml-2 text-sm flex flex-col">
                    <label for="raison_signal" class="font-medium text-gray-900 dark:text-gray-300">raison type</label>
                    <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">Add raison
                        of signal for user(why he signal)</p>
                </div>
            </div>
            <div class="flex" style="display: flex">
                <div class="flex items-center h-5">
                    <input name="commentaire" id="commentaire" aria-describedby="helper-checkbox-text" type="checkbox"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </div>
                <div class="ml-2 text-sm flex flex-col">
                    <label for="commentaire" class="font-medium text-gray-900 dark:text-gray-300">comment</label>
                    <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">Add
                        comment of signal for user</p>
                </div>
            </div>

            <div style="float: right">
                <button type="submit" value="Save"
                        class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    add input
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const form = document.getElementById('form');
        form.addEventListener('submit', event => {
            let commentaireInput;
            let raisonInput;
            let typeInput;
            let emailInput;
            let prenomInput;
            let nomInput;
            event.preventDefault();
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);
            if (data.nom === 'on') {
                nomInput = `<div class="flex flex-col">
                                    <label for="nom">nom:</label>
                                    <input type="text" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>`;
            } else {
                nomInput = `<input type="hidden" value=' ' name="nom" id="nom">`;
            }
            if (data.prenom === 'on') {
                prenomInput = `<div class="flex flex-col">
                                    <label for="prenom">prenom:</label>
                                    <input type="text" name="prenom" id="prenom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>`;
            } else {
                prenomInput = `<input type="hidden" value=' ' name="prenom" id="prenom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">`;
            }
            if (data.email === 'on') {
                emailInput = `<div class="flex flex-col">
                                    <label for="email">email:</label>
                                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>`;
            } else {
                emailInput = `<input type="hidden" value=' ' name="email" id="email">`;
            }
            if (data.type_signal === 'on') {
                typeInput = `<div class="flex flex-col">
                                    <label for="type_signal">type de signal:</label>
                                    <select name="type_signal" id="type_signal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="type 1">type 1</option>
                                        <option value="type 2">type 2</option>
                                        <option value="type 3">type 3</option>
                                    </select>
                                </div>`;
            } else {
                typeInput = `<input type="hidden" value=' ' name="type_signal" id="type_signal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">`;
            }
            if (data.raison_signal === 'on') {
                raisonInput = `<div class="flex flex-col">
                                    <label for="raison_signal">raison de signal:</label>
                                    <select name="raison_signal" id="raison_signal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="raison 1">raison 1</option>
                                        <option value="raison 2">raison 2</option>
                                        <option value="raison 3">raison 3</option>
                                    </select>
                                </div>`;
            } else {
                raisonInput = `<input type="hidden" value=' ' name="raison_signal" id="raison_signal">`;
            }
            if (data.commentaire === 'on') {
                commentaireInput = `<div class="flex flex-col">
                                    <label for="commentaire">commentaire:</label>
                                    <textarea style="resize:none" name="commentaire" id="commentaire" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" cols="20" rows="10"></textarea>
                                </div>`;
            } else {
                commentaireInput = `<input type="hidden" value=' ' name="commentaire" id="commentaire">`;
            }
            const action = "<?php echo esc_url(admin_url('admin-post.php')); ?>";

            const formSelected = `
            <div class="flex  flex-col justify-center">
                <form class="form rounded-lg border-2 border-gray-600 flex flex-col justify-center space-y-3 p-11"
                      id="form" style="margin: 0;padding: 60px 10px;padding-bottom: 20px;width: 100%;"
                      method="post"
                      action="${action}"
                >
                    <div class="flex flex-col">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Signal Form :</h3>
                        <p class="text-2xl text-gray-500 dark:text-gray-100">veillez remplire les champs</p>
                    </div>
                        ${nomInput}
                        ${prenomInput}
                        ${emailInput}
                        ${typeInput}
                        ${raisonInput}
                        ${commentaireInput}
                    <div>
                    <input type="hidden" name="action" value="registerSignal">
                    <button type="submit" value="Envoyer" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Submit</button>
                    </div>
                </form>
            </div>`;
            localStorage.setItem("formSelected", formSelected)
            Swal.fire(
                'Form added successfully',
                'check your page',
                'success'
            )
        })
    </script>
    <?php
}

function shortcodeSignal(): bool|string
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    <script>
        const p = document.getElementById('p');
        const formSelected = localStorage.getItem("formSelected");
        p.innerHTML = formSelected
    </script>
    <?php
    return ob_get_clean();
}

add_shortcode('form_signal', 'shortcodeSignal');

#[NoReturn] function registerSignal(): void
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

add_action('admin_post_registerSignal', 'registerSignal');
function affiche_addMenuPageSignal(): void
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

add_action('admin_menu', 'affiche_addMenuPageSignal');

function affiche_Signal_callback(): void
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'signal';

    $results = $wpdb->get_results("SELECT * FROM $table_name");
    ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>

    <div class="text" style="padding-top: 60px">
        <h1 class="text-2xl font-bold text-gray-700 dark:text-gray-200">Signal :</h1>
    </div>

    <div class="container" style="padding-right: 15px;padding-top: 20px">

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        nom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        prenom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        type signal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        raison signal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        commentaire
                    </th>
                    <th scope="col" class="px-6 py-3">
                        date
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($results as $result) { ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            <?= $result->nom ?? 'No First name' ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $result->prenom ?? 'No Last Name name' ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $result->email ?? 'No email' ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $result->type_signal ?? 'No signal type' ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $result->raison_signal ?? 'No signal raison' ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $result->commentaire ?? 'No commentaire' ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $result->date ?? 'No date' ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}

?>