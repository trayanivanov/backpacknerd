// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

require('bootstrap/dist/js/bootstrap.bundle');

// lightbox
import SimpleLightbox from "simplelightbox";
(function() {
    new SimpleLightbox('.article-gallery a', {'captionPosition': 'outside'});
})();