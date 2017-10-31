let notes = [
    'ndwqd dowqboi nwoi',
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aperiam deserunt error est hic in, nihil perspiciatis provident quasi qui quis quod recusandae sequi suscipit voluptates. Eveniet nisi recusandae voluptatem!',
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aperiam deserunt error est hic in, nihil perspiciatis provident quasi qui quis quod recusandae sequi suscipit voluptates. Eveniet nisi recusandae voluptatem! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aperiam deserunt error est hic in, nihil perspiciatis provident quasi qui quis quod recusandae sequi suscipit voluptates. Eveniet nisi recusandae voluptatem!'
];
let noteID = 0;


$(function() {
    //When the page is first loaded, populate the ticket info
    // populateTicketInfo();
    populateTicketInfo()


    //When the notes modal is shown, update the note textarea to match the note it was clicked on
    $('#notesModal').on('show.bs.modal', function(event) {
        // console.log($(event.relatedTarget).data());
        noteID = $(event.relatedTarget).data('noteId');
        // console.log(noteID)

        let noteModal = $(this);
        noteModal.find('.modal-body textarea').val(notes[noteID]);
    })

    //Save the note displayed in the modal when the save button is clicked
    $('#saveNote').on('click', function() {
        let note = $('.modal-body textarea').val();
        console.log(noteID)
        console.log(notes)
        notes[noteID] = note;
        console.log(notes);

    //    Update the ticket page
        populateTicketInfo();

    //    Close the modal
        $('#notesModal').modal('hide');
    })


});

function populateTicketInfo() {
    // Make sure the notes section is empty to prevent repetitions
    $('#note-list').html('')
    for (i in notes) {
        makeNote(i);
    }

}

function makeNote(noteID) {
    // Template for making a note
    // `<button type="button" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#notesModal" data-note-id="0">
    //     <small>19/09/2018 06:10</small><br>
    // <span>some notes</span>
    // </button>`

    let noteElement = document.createElement('button')
    noteElement.setAttribute('type', 'button');
    noteElement.setAttribute('class', 'list-group-item list-group-item-action');
    noteElement.setAttribute('data-toggle', 'modal');
    noteElement.setAttribute('data-target', '#notesModal');
    noteElement.setAttribute('data-note-id', noteID);

    let date = new Date();
    // let dateString = date.getDate() + '/' + (date.getMonth()+1) + '/' + date.getFullYear() + ' ' + date.getHours() + ':' + date.getMinutes();

    let dateString = `${date.getDate()}/${date.getMonth()+1}/${date.getFullYear()} ${date.getHours()}:${date.getMinutes()}`;

    let dateTimeText = document.createElement('small');
    dateTimeText.appendChild(document.createTextNode(dateString));
    noteElement.appendChild(dateTimeText);
    noteElement.appendChild(document.createElement('br'));

    let noteText = document.createElement('span');
    noteText.appendChild(document.createTextNode(notes[noteID]));
    noteElement.appendChild(noteText);

    $('#note-list').append(noteElement)
}
