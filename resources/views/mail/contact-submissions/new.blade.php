<x-mail::message>
# Nueva solicitud de demostración

**Nombre:** {{ $submission->name }}  
**Organización:** {{ $submission->company }}  
**Cargo:** {{ $submission->position ?: 'No informado' }}  
**Correo:** {{ $submission->email }}  
**Teléfono:** {{ $submission->phone ?: 'No informado' }}  
**Usuarios estimados:** {{ $submission->estimated_users ?: 'No informado' }}

## Necesidades

{{ collect($submission->needs)->join(', ') ?: 'No especificadas' }}

## Mensaje

{{ $submission->message }}

<x-mail::button :url="route('admin.contacts.show', $submission)">
Ver solicitud en administración
</x-mail::button>

SLAD
</x-mail::message>
