# CKEditor 5 classic editor build v16.0.0

In order to start using CKEditor 5 Builds, configure or customize them, please visit http://docs.ckeditor.com/ckeditor5/latest/builds/index.html

## License

Licensed under the terms of [GNU General Public License Version 2 or later](http://www.gnu.org/licenses/gpl.html).
For full details about the license, please check the LICENSE.md file.

//this is how you initialize

jQuery(document).ready(function() {
ClassicEditor
.create(document.querySelector('#body'), {
toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
'blockQuote'
],
heading: {
options: [{
model: 'paragraph',
title: 'Paragraph',
class: 'ck-heading_paragraph'
},
{
model: 'heading1',
view: 'h1',
title: 'Heading 1',
class: 'ck-heading_heading1'
},
{
model: 'heading2',
view: 'h2',
title: 'Heading 2',
class: 'ck-heading_heading2'
}
]
}
});
});
