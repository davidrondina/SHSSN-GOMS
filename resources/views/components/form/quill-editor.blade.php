 @props(['input_name' => 'editor', 'editor_class' => 'h-32'])

 <div x-data="quillEditor" class="w-auto h-auto">
     <div x-ref="editor" id="editor" class="{{ $editor_class }}">
         {!! old($input_name) !!}
     </div>
     <input type="hidden" name="{{ $input_name }}" x-model="content">
 </div>

 @push('js')
     {{-- <script>
         const quill = new Quill('#editor', {
             modules: {
                 toolbar: [
                     ['bold', 'italic'],
                     ['link'],
                     [{
                         list: 'ordered'
                     }, {
                         list: 'bullet'
                     }],
                 ],
             },
             theme: 'snow',
         });
     </script> --}}
 @endpush
