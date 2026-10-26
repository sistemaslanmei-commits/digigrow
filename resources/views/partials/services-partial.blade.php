<!-- Parcial Reutilizable de Servicios -->
<div class="row g-4">
    @forelse($services as $service)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card bg-white">
                <div class="bg-light p-4 text-center">
                    @if($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" class="img-fluid rounded" alt="{{ $service->name }}" style="max-height: 180px; object-fit: contain;">
                    @else
                        <div class="py-4 text-primary">
                            <i class="fas fa-tools fa-4x"></i>
                        </div>
                    @endif
                </div>
                <div class="card-body p-4 d-flex flex-column">
                    <h5 class="fw-bold text-dark mb-2">{{ $service->name }}</h5>
                    <p class="text-muted small leading-relaxed flex-grow-1">{{ $service->description }}</p>
                    
                    @if(!empty($setting?->whatsapp))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}?text=Hola,%20deseo%20mayor%20información%20sobre%20el%20servicio:%20{{ urlencode($service->name) }}" 
                           target="_blank" class="btn btn-outline-success rounded-pill btn-sm w-100 mt-3 fw-bold">
                            <i class="fab fa-whatsapp me-1"></i> Consultar Servicio
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center py-4 mb-0 rounded-4">
                <i class="fas fa-info-circle fa-2x mb-2"></i>
                <p class="mb-0">No hay servicios registrados actualmente.</p>
            </div>
        </div>
    @endforelse
</div>