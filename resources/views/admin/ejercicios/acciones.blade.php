<a href="{{ route('admin.ejercicios.edit', $e->id) }}"
   class="btn btn-sm btn-warning"
   title="Editar">
    <i class="fas fa-edit"></i>
</a>

<form action="{{ route('admin.ejercicios.destroy', $e->id) }}"
      method="POST"
      style="display:inline-block"
      onsubmit="return confirm('¿Eliminar este ejercicio?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" title="Eliminar">
        <i class="fas fa-trash"></i>
    </button>
</form>
