$(document).ready(function() {
    // $('label.required').remove();
    //
    // /**gestion formulaire formation**/
    // var $formationExist;
    // var $form_formation = $('div.form_formation');
    // var addFormation    = addLink('Formation');
    // var removeFormation = removeForm('Formation');
    // $form_formation.append(addFormation);
    // $form_formation.data('index', $form_formation.find(':input').length);
    // $formationExist = $($form_formation).data('prototype');
    // if( $($formationExist).length <= 1){
    //     addTagForm($form_formation, addFormation, removeFormation);
    // }
    // addFormation.on('click', function(e) {
    //     e.preventDefault();
    //     addTagForm($form_formation, addFormation, removeFormation);
    // });
    // /*** fin formulaire formation**/
    //
    // /**gestion formulaire experience**/
    // var $form_experienceExist;
    // var $formExperience = $('div.form_experience');
    // var addExperience    = addLink('Experience');
    // var removeExperience = removeForm('Experience');
    // $formExperience.append(addExperience);
    // $formExperience.data('index', $formExperience.find(':input').length);
    // $form_experienceExist = $formExperience.data('prototype');
    // if( $($form_experienceExist).length <= 1){
    //     addTagForm($formExperience, addExperience, removeExperience);
    // }
    // addExperience.on('click', function(e) {
    //     e.preventDefault();
    //     addTagForm($formExperience, addExperience, removeExperience);
    // });
    // /*** fin formulaire experience**/

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
    /*** fin formulaire experience**/

   /*** mise en place du chosen ***/
    $('.emploiRechercher').chosen();
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




//
//
//
// function addTagForm($collectionHolder, $addForm, removeForm) {
//     var prototype = $collectionHolder.data('prototype');
//     var index = $collectionHolder.data('index');
//     var newForm = prototype.replace(/__name__/g, index).replace(index+"label__", "");
//     var $newFormBlock = $('<div></div>').append(newForm);
//     $collectionHolder.data('index', index + 1);
//     $addForm.before($newFormBlock);
//     addTagFormDelete($newFormBlock, index, removeForm);
// }
//
// function addTagFormDelete($tagForm, index, removeLink) {
//     $tagForm.append(removeLink);
//     removeLink.on('click', function(e) {
//         e.preventDefault();
//         $tagForm.remove();
//         index = (index - 1) ;
//     });
// }
