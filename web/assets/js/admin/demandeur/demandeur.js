$(document).ready(function() {

    /**gestion formulaire formation**/
    var $formationExist;
    var $form_formation = $('div.form_formation');
    var addFormation    = addLink('Formation');
    var removeFormation = removeForm('Formation');
    $form_formation.append(addFormation);
    $form_formation.data('index', $form_formation.find(':input').length);
    $formationExist = $form_formation.data('prototype');
    if( $($formationExist).length <= 0){
        addTagForm($form_formation, addFormation, removeFormation);
    }
    addFormation.on('click', function(e) {
        e.preventDefault();
        addTagForm($form_formation, addFormation, removeFormation);
    });
    /*** fin formulaire formation**/

    /**gestion formulaire experience**/
    var $form_experienceExist;
    var $formExperience = $('div.form_experience');
    var addExperience    = addLink('Experience');
    var removeExperience = removeForm('Experience');
    $formExperience.append(addExperience);
    $formExperience.data('index', $formExperience.find(':input').length);
    $form_experienceExist = $formExperience.data('prototype');
    if( $($form_experienceExist).length <= 0){
        addTagForm($formExperience, addExperience, removeExperience);
    }
    addExperience.on('click', function(e) {
        e.preventDefault();
        addTagForm($formExperience, addExperience, removeExperience);
    });
    /*** fin formulaire experience**/
});

function addLink($label){
    var $addLinkAdd = $('<a href="#" class="btn btn-primary">Ajouter ' + $label + '</a>');
    return $addLinkAdd ;
}

function removeForm($name) {
    var $removeFormA = $('<a href="#" class="btn btn-danger">Supprimer ' + $name + '</a>');
    return $removeFormA ;
}

function addTagForm($collectionHolder, $addForm, removeForm) {
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype.replace(/__name__/g, index).replace(index+"label__", "");
    var $newFormBlock = $('<div></div>').append(newForm);
    $collectionHolder.data('index', index + 1);
    $addForm.before($newFormBlock);
    addTagFormDelete($newFormBlock, index, removeForm);
}

function addTagFormDelete($tagForm, index, removeLink) {
    $tagForm.append(removeLink);
    removeLink.on('click', function(e) {
        e.preventDefault();
        $tagForm.remove();
        index = (index - 1) ;
    });
}
