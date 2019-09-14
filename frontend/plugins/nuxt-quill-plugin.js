import Vue from 'vue'
import VueQuillEditor from 'vue-quill-editor/dist/ssr'
// import Quill from 'quill'
// import { ImageDrop } from 'quill-image-drop-module'
// import ImageResize from 'quill-image-resize-module'
// Quill.register('modules/imageDrop', ImageDrop)
// Quill.register('modules/imageResize', ImageResize)
$("img").attr("width", "300px");
Vue.use(VueQuillEditor)