$(document).ready(function() {

    /**gestion formulaire telephone**/
    var $telephone  = $('div.telephone');
    var $index      = $telephone.find(':input').length;
    var addTel      = $('.addTel');
    addTel.on('click', function(e) {
        e.preventDefault();
        addForm($telephone);
    });
    if ($index == 0) {
        addForm($telephone);
    }else{
        $telephone.children('div').each(function() {
            addDeleteLink($(this));
        });
    }
    /*** fin formulaire telephone**/

    /**gestion formulaire formation**/
    var $form_formation = $('div.form_formation');
    var $iteration      = $form_formation.find(':input').length;
    var addFormation    = $('.addFormation');
    addFormation.on('click', function(e) {
        e.preventDefault();
        addForm($form_formation);
    });

    if ($iteration == 0) {
        addForm($form_formation);
    }else{
        $form_formation.children('div').each(function() {
            addDeleteLink($(this));
        });
    }
    /*** fin formulaire formation**/

    /**gestion formulaire experience**/

    var $formExperience = $('div.form_experience');
    var $iterat         = $formExperience.find(':input').length;
    var addExperience   = $('.addExperience');
    addExperience.on('click', function(e) {
        e.preventDefault();
        addForm($formExperience);
    });

    if ($iterat == 0) {
        addForm($formExperience);
    }else{
        $formExperience.children('div').each(function() {
            addDeleteLink($(this));
        });
    }
    /*** fin formulaire experience**/
    /*** mise en place du chosen ***/
    $('.emploiRechercher').chosen();
    $('.listSearch').chosen();
    $('.manySelect').chosen();
});

function addForm($container){
    var $i         = $container.find(':input').length;
    var template   = $container.attr('data-prototype').replace(/__name__label__/g, "").replace(/__name__/g, $i);
    var $prototype = $(template);
    $prototype.find(':input').addClass('form-control') ;
    if ($i != 0){
        addDeleteLink($prototype);
    }
    $container.append($prototype);
    $i ++;
}

function addDeleteLink($prototype) {
    $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');
    $prototype.append($deleteLink);
    $deleteLink.click(function(e) {
        $prototype.remove();
        e.preventDefault();
        return false;
    });
}