<!-- <template>
  <div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <div class="content">

          <div
            class="quill-editor"
            :content="content"
            @change="onEditorChange($event)"
            @blur="onEditorBlur($event)"
            @focus="onEditorFocus($event)"
            @ready="onEditorReady($event)"
            v-quill:myQuillEditor="editorOption"
          ></div>

    </div>
    <br>
  </div>

</template>

<script>

import Vue from "vue";

export default {
  beforeMount() {
    const VueQuillEditor = require("vue-quill-editor/dist/ssr");
    const Quill = require("quill");
    const {
      container,
      ImageExtend,
      QuillWatch
    } = require("quill-image-extend-module");

    const { ImageDrop } = require("quill-image-drop-module");

    const ImageResize = require("quill-image-resize-module");

    Quill.register("modules/ImageExtend", ImageExtend);
    Quill.register("modules/ImageResize", ImageResize);
    Quill.register("modules/imageDrop", ImageDrop);

    Vue.use(VueQuillEditor);
    this.editorOption = {
      // some quill options
      modules: {
        imageResize: {
          displayStyles: {
            backgroundColor: "black",
            border: "none",
            color: "white"
          },
          modules: ["Resize", "DisplaySize", "Toolbar"]
        },
        imageDrop: true,
        ImageExtend: {
          // 如果不作设置，即{}  则依然开启复制粘贴功能且以base64插入
          name: "img", // 图片参数名
          size: 3, // 可选参数 图片大小，单位为M，1M = 1024kb
          action: "", // 服务器地址, 如果action为空，则采用base64插入图片
          // response 为一个函数用来获取服务器返回的具体图片地址
          // 例如服务器返回{code: 200; data:{ url: 'baidu.com'}}
          // 则 return res.data.url
          response: res => {
            return res.info;
          },

          sizeError: () => {}, // 图片超过大小的回调
          start: () => {}, // 可选参数 自定义开始上传触发事件
          end: () => {}, // 可选参数 自定义上传结束触发的事件，无论成功或者失败
          error: () => {}, // 可选参数 上传失败触发的事件
          success: () => {}, // 可选参数  上传成功触发的事件
          change: (xhr, formData) => {
            // xhr.setRequestHeader('myHeader','myValue')
            // formData.append('token', 'myToken')
          } // 可选参数 每次选择图片触发，也可用来设置头部，但比headers多了一个参数，可设置formData
        },
        toolbar: {
          // 如果不上传图片到服务器，此处不必配置
          container: container, // container为工具栏，此次引入了全部工具栏，也可自行配置
          handlers: {
            image: function() {
              // 劫持原来的图片点击按钮事件
              QuillWatch.emit(this.quill.id);
            }
          }
        }
      }
    };
  },
  data() {
    return {
      content: "<p>I am Example</p>",
      editorOption: null
    };
  },
 // components: { Header, Footer },
  mounted() {
    console.log("app init, my quill insrance object is:", this.myQuillEditor);
    setTimeout(() => {
      this.content = "i am changed";
    }, 3000);
  },
  methods: {
    onEditorBlur(editor) {
      console.log("editor blur!", editor);
    },
    onEditorFocus(editor) {
      console.log("editor focus!", editor);
    },
    onEditorReady(editor) {
      // editor.registerModule("modules/imageResize", ImageResize);
      // editor.registerModule("modules/imageDrop", ImageDrop);
      console.log("editor ready!", editor);
    },
    onEditorChange({ editor, html, text }) {
      console.log("editor change!", editor, html, text);
      this.content = html;
    }
  }
};
</script>

<style scoped >
.content {
  margin: 0 auto;
  width: 1120px;
  border-radius: 3px;
  transition: 0.2s;
  margin-top: 50px;
  overflow: hidden;
}
</style> -->