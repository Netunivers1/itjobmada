var $collectionHolder;
var $formEixst ;
var $addTagLink = $('<a href="#" class="btn btn-primary">Ajouter Formation</a>');

$(document).ready(function() {
    $collectionHolder = $('div.form_cvs');
    $collectionHolder.append($addTagLink);
    $collectionHolder.data('index', $collectionHolder.find(':input').length);
    $formEixst = $collectionHolder.data('prototype');
    console.log( $($formEixst).length ) ;
    $addTagLink.on('click', function(e) {
        e.preventDefault();
        addTagForm($collectionHolder);
    });
});

function addTagForm($collectionHolder) {
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype.replace(/__name__/g, index).replace(index+"label__", "");
    var $newFormLi = $('<div></div>').append(newForm);

    $collectionHolder.data('index', index + 1);
    $addTagLink.before($newFormLi);
    addTagFormDelete($newFormLi, index);
}

function addTagFormDelete($tagForm, index) {
    var $removeFormA = $('<a href="#" class="btn btn-danger">Supprimer Formation</a>');
    $tagForm.append($removeFormA);
    $removeFormA.on('click', function(e) {
        e.preventDefault();
        $tagForm.remove();
        index = (index - 1) ;
    });
}
