<!-- Canales de Atención e Información Directa -->
<div class="row g-4 justify-content-center mb-5">
    @if(!empty($setting?->phone))
        <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm text-center p-4 bg-white rounded-4">
                <i class="fas fa-phone-alt fa-3x text-primary mb-3"></i>
                <h5 class="fw-bold text-dark">Teléfono</h5>
                <p class="text-muted mb-0">{{ $setting->phone }}</p>
            </div>
        </div>
    @endif

    @if(!empty($setting?->email))
        <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm text-center p-4 bg-white rounded-4">
                <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                <h5 class="fw-bold text-dark">Correo Electrónico</h5>
                <p class="text-muted mb-0">{{ $setting->email }}</p>
            </div>
        </div>
    @endif

    @if(!empty($setting?->address))
        <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm text-center p-4 bg-white rounded-4">
                <i class="fas fa-map-marker-alt fa-3x text-primary mb-3"></i>
                <h5 class="fw-bold text-dark">Dirección</h5>
                <p class="text-muted mb-0">{{ $setting->address }}</p>
            </div>
        </div>
    @endif
</div>

<!-- Botón de Atención Inmediata por WhatsApp -->
@if(!empty($setting?->whatsapp))
    <div class="text-center mb-5">
        <div class="bg-white p-4 rounded-4 shadow-sm d-inline-block">
            <h4 class="fw-bold text-dark mb-3">¿Necesitas una respuesta rápida?</h4>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}?text=Hola,%20deseo%20contactar%20con%20un%20asesor" 
               target="_blank" class="btn btn-success btn-lg rounded-pill px-4 fw-bold shadow-sm">
                <i class="fab fa-whatsapp me-2"></i> Chatear con un Asesor
            </a>
        </div>
    </div>
@endif

<!-- Formulario de Envío de Mensajes (Día 9) -->
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h4 class="fw-bold text-dark mb-3 text-center">
                <i class="fas fa-paper-plane text-primary me-2"></i>Envíanos un Mensaje Directo
            </h4>
            <p class="text-muted text-center mb-4 small">Completa el formulario y nos pondremos en contacto a la brevedad.</p>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="contact_name" class="form-label small fw-semibold">Nombre Completo</label>
                        <input type="text" id="contact_name" name="name" class="form-control" placeholder="Ej. Juan Pérez" required>
                    </div>
                    <div class="col-md-6">
                        <label for="contact_email" class="form-label small fw-semibold">Correo Electrónico</label>
                        <input type="email" id="contact_email" name="email" class="form-control" placeholder="ejemplo@empresa.com" required>
                    </div>
                    <div class="col-md-6">
                        <label for="contact_phone" class="form-label small fw-semibold">Teléfono / WhatsApp (Opcional)</label>
                        <input type="text" id="contact_phone" name="phone" class="form-control" placeholder="+51 999 999 999">
                    </div>
                    <div class="col-md-6">
                        <label for="contact_subject" class="form-label small fw-semibold">Asunto (Opcional)</label>
                        <input type="text" id="contact_subject" name="subject" class="form-control" placeholder="Cotización o consulta">
                    </div>
                    <div class="col-12">
                        <label for="contact_msg" class="form-label small fw-semibold">Mensaje o Consulta</label>
                        <textarea id="contact_msg" name="message" class="form-control" rows="4" placeholder="¿En qué podemos ayudarte?" required></textarea>
                    </div>
                    <div class="col-12 mt-4 text-center">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold py-2">
                            <i class="fas fa-paper-plane me-2"></i> Enviar Mensaje
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>