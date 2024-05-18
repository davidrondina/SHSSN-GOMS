 @props(['content' => null, 'input_name' => 'editor', 'editor_class' => 'h-32'])

 <div x-data="quillEditor" class="w-auto h-auto">
     <div x-ref="editor" id="editor" class="{{ $editor_class }}">
         {!! old($input_name) ?? $content !!}
     </div>
     <input type="hidden" name="{{ $input_name }}" x-model="content">
 </div>

 <x-form.input-error :messages="$errors->get($input_name)" class="mt-2" />

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
