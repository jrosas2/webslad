<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            'home' => ['Home', 'Gestione sus causas jurídicas de forma simple, segura y centralizada', 'SLAD | Gestión jurídica centralizada', 'Centralice causas, actuaciones, documentos, responsables y plazos jurídicos en una plataforma empresarial segura.'],
            'producto' => ['Producto', 'Una plataforma para gestionar todo el ciclo de una causa', 'Producto SLAD | Plataforma de gestión jurídica', 'Conozca las funcionalidades de SLAD para causas, actuaciones, documentos, plazos, finanzas, auditoría y control de accesos.'],
            'nosotros' => ['Nosotros', 'Tecnología aplicada a una gestión jurídica más organizada', 'Nosotros | SLAD Legaltech', 'Conozca el propósito, la visión y los principios que orientan el desarrollo de SLAD.'],
            'contacto' => ['Contacto', 'Conversemos sobre su gestión jurídica', 'Contacto | Solicite una demostración de SLAD', 'Solicite una demostración de SLAD y converse con nuestro equipo sobre las necesidades de su organización.'],
        ];

        foreach ($pages as $slug => [$name, $title, $metaTitle, $metaDescription]) {
            Page::query()->updateOrCreate(['slug' => $slug], [
                'name' => $name,
                'title' => $title,
                'meta_title' => $metaTitle,
                'meta_description' => $metaDescription,
                'is_active' => true,
            ]);
        }

        $this->seedHome();
        $this->seedProduct();
        $this->seedAbout();
        $this->seedContact();
        $this->seedSettings();
    }

    private function seedHome(): void
    {
        $page = Page::query()->where('slug', 'home')->firstOrFail();

        $this->section($page, 'home.hero', 'Gestione sus causas jurídicas de forma simple, segura y centralizada', 'SLAD reúne en una sola plataforma la información de sus causas, actuaciones, responsables, documentos, movimientos financieros y fechas importantes, facilitando el seguimiento y control de la gestión jurídica.', [
            'eyebrow' => 'Plataforma SaaS de Litigio & Cumplimiento',
            'primary_cta' => 'Solicitar demostración',
            'secondary_cta' => 'Conocer el producto',
            'trust' => ['Cifrado TLS 1.3 & AES-256', 'Trazabilidad inmutable', 'Acceso web multi-perfil'],
            'metrics' => [
                ['label' => 'Causas vigentes', 'value' => '148', 'detail' => '+12% este mes'],
                ['label' => 'Causas cerradas', 'value' => '64', 'detail' => 'Tasa de éxito 91%'],
                ['label' => 'Recordatorios', 'value' => '8', 'detail' => '3 plazos fatales'],
            ],
        ], 10);

        $this->section($page, 'home.problem', 'Toda la gestión jurídica en un solo lugar', 'El trabajo disperso genera riesgos operativos, pérdidas de plazos y sobrecarga en los equipos de asesoría legal. Compare la operación tradicional con el estándar SLAD.', [
            'eyebrow' => 'Diagnóstico vs. modernización',
            'problems' => [
                ['title' => 'Pérdida de trazabilidad', 'description' => 'Desconocimiento de quién editó un escrito.'],
                ['title' => 'Dificultad de búsqueda', 'description' => 'Horas invertidas rastreando expedientes viejos.'],
                ['title' => 'Duplicidad de registros', 'description' => 'Versiones dispares de una misma causa.'],
                ['title' => 'Vencimiento de plazos', 'description' => 'Riesgo de caducidad o preclusión.'],
            ],
            'solutions' => [
                ['title' => 'Trazabilidad integral por causa', 'description' => 'Línea de tiempo de cada escrito, resolución, comparecencia y documento.'],
                ['title' => 'Control granular de accesos y roles', 'description' => 'Perfiles precisos para socios, abogados, procuradores y auditores.'],
                ['title' => 'Alertas preventivas automatizadas', 'description' => 'Notificaciones previas a plazos fatales, audiencias y gestiones pendientes.'],
                ['title' => 'Repositorio central inalterable', 'description' => 'Expedientes indexados, versiones y respaldos automatizados.'],
            ],
        ], 20);

        $this->section($page, 'home.features', 'Funcionalidades diseñadas para la precisión jurídica', 'Módulos integrados creados para responder a la rigurosidad procesal, el secreto profesional y la eficiencia organizativa.', [
            'eyebrow' => 'Arquitectura de operación',
            'items' => [
                ['icon' => 'scale', 'title' => 'Gestión de causas', 'description' => 'Caratulación unificada, tribunales, materias, rol interno y estados procesales en tiempo real.'],
                ['icon' => 'clock', 'title' => 'Historial de actuaciones', 'description' => 'Cronología de hechos, escritos, traslados, comparecencias y resoluciones.'],
                ['icon' => 'folder', 'title' => 'Documentos adjuntos', 'description' => 'Expedientes, medios de prueba y anexos con control de versiones.'],
                ['icon' => 'bell', 'title' => 'Recordatorios y alertas', 'description' => 'Avisos anticipados de plazos fatales, audiencias y vencimientos procesales.'],
                ['icon' => 'banknotes', 'title' => 'Gestión financiera', 'description' => 'Ingresos, egresos, gastos judiciales, honorarios y balance por causa.'],
                ['icon' => 'fingerprint', 'title' => 'Bitácora de auditoría', 'description' => 'Registro sellado de cada acción, usuario, fecha y hora.'],
            ],
        ], 30);

        $this->section($page, 'home.benefits', 'Más control. Menos trabajo administrativo.', 'Optimice el tiempo de su equipo legal reemplazando tareas manuales repetitivas por un estándar unificado de gestión estratégica.', [
            'eyebrow' => 'Impacto operativo',
            'items' => [
                ['title' => 'Información centralizada', 'description' => 'Un único punto de consulta para expedientes, resoluciones y escritos.'],
                ['title' => 'Mejor seguimiento de causas', 'description' => 'Monitoreo del progreso procesal sin correos de coordinación interna.'],
                ['title' => 'Control de responsables', 'description' => 'Asignación transparente de titulares, reemplazos y procuradores.'],
                ['title' => 'Trazabilidad de cambios', 'description' => 'Histórico de usuario, fecha y hora de cada modificación.'],
                ['title' => 'Acceso rápido a documentos', 'description' => 'Localice demandas, sentencias y pruebas mediante filtros.'],
                ['title' => 'Recordatorios oportunos', 'description' => 'Alertas para reducir el riesgo de omisión y preclusión.'],
                ['title' => 'Estadísticas de gestión', 'description' => 'Carga de trabajo, tiempos de resolución y balances de costos.'],
                ['title' => 'Cero dependencia de Excel', 'description' => 'Una base segura y colaborativa reemplaza planillas dispersas.'],
            ],
        ], 40);

        $this->section($page, 'home.audience', 'Diseñado para organizaciones que gestionan múltiples causas', 'SLAD escala según la estructura de su entidad, con parametrización de carátulas, tribunales y perfiles de acceso.', [
            'eyebrow' => 'Ecosistema institucional',
            'items' => [
                ['title' => 'Estudios jurídicos', 'tag' => 'Despachos · Boutiques', 'description' => 'Centralice la cartera litigiosa de clientes con asignación de procuradores y reportería ejecutiva.'],
                ['title' => 'Empresas con áreas legales', 'tag' => 'Fiscalías internas', 'description' => 'Supervise litigios gestionados por abogados internos y firmas externas.'],
                ['title' => 'Instituciones públicas', 'tag' => 'Sector público', 'description' => 'Bitácoras inmutables y control administrativo para máxima probidad.'],
                ['title' => 'Departamentos jurídicos', 'tag' => 'Unidades asesoras', 'description' => 'Ordene requerimientos, opiniones legales y gastos judiciales.'],
                ['title' => 'Corporaciones', 'tag' => 'Holdings · Grupos', 'description' => 'Contingencias de múltiples filiales con permisos segmentados.'],
                ['title' => 'Organizaciones con gestión de litigios', 'tag' => 'Cobranza · Litigio masivo', 'description' => 'Opere altos volúmenes con trazabilidad de hitos y plazos fatales.'],
            ],
        ], 50);

        $this->section($page, 'home.cta', 'Conozca cómo SLAD puede mejorar la gestión jurídica de su organización', 'Solicite una demostración y conozca cómo adaptar SLAD a las necesidades de su equipo.', ['eyebrow' => 'Atención personalizada', 'button' => 'Solicitar demostración'], 60);
    }

    private function seedProduct(): void
    {
        $page = Page::query()->where('slug', 'producto')->firstOrFail();

        $this->section($page, 'producto.hero', 'Una plataforma para gestionar todo el ciclo de una causa', 'Centralice información, documentos, actuaciones, responsabilidades y fechas importantes desde una única plataforma diseñada para la máxima precisión operativa y jurídica.', ['eyebrow' => 'Plataforma legal empresarial', 'pillars' => ['Visión centralizada', 'Plazos bajo control', 'Historial íntegro', 'Trabajo por roles']], 10);
        $this->section($page, 'producto.cases', 'Gestión Integral de Causas', 'Administre cada expediente desde su radicación hasta su archivo. Consolide carátulas, juzgados, montos y responsables en una vista sincronizada con el panel de detalle.', ['rows' => [
            ['rol' => 'C-1234-2025', 'name' => 'Banco Andino c/ Comercial SpA', 'status' => 'En tramitación', 'amount' => '$45.000.000'],
            ['rol' => 'O-4609-2026', 'name' => 'Morales c/ Logística Global', 'status' => 'Prueba', 'amount' => '$23.450.000'],
            ['rol' => 'C-8921-2024', 'name' => 'Inmobiliaria del Parque c/ Constructora', 'status' => 'Fallo notificado', 'amount' => '$12.000.000'],
            ['rol' => 'P-302-2026', 'name' => 'Asociación c/ Concesionaria Norte', 'status' => 'En acuerdo', 'amount' => '$90.000.000'],
        ]], 20);
        $this->section($page, 'producto.actions', 'Historial completo de cada causa', 'Cada causa mantiene un historial cronológico inalterable de actuaciones judiciales y extrajudiciales. Ningún movimiento procesal queda sin autoría ni fecha fehaciente.', ['items' => [
            ['date' => '11/09/2026 — 16:45', 'title' => 'Presentación de escrito', 'description' => 'Se acompaña liquidación de crédito con cargo a intereses.'],
            ['date' => '08/09/2026 — 10:15', 'title' => 'Resolución recibida', 'description' => 'Notificación electrónica del tribunal incorporada al expediente.'],
            ['date' => '02/09/2026 — 14:02', 'title' => 'Antecedentes incorporados', 'description' => 'Documentos probatorios anexados y verificados.'],
        ]], 30);
        $this->section($page, 'producto.responsibles', 'Control claro sobre quién está a cargo', 'Las causas pueden asignarse a usuarios responsables. Cada funcionario o abogado visualiza exclusivamente lo que corresponde a sus facultades institucionales.', ['items' => [
            ['name' => 'Mario Castro', 'role' => 'Procurador', 'count' => '22 causas'],
            ['name' => 'Álvaro Valenzuela', 'role' => 'Abogado litigante', 'count' => '14 causas'],
            ['name' => 'Camila Rivas', 'role' => 'Especialista laboral', 'count' => '9 causas'],
        ]], 40);
        $this->section($page, 'producto.documents', 'Documentos asociados directamente a cada causa', 'Almacenamiento seguro para archivos y expedientes, visualización inmediata y trazabilidad de versiones.', ['items' => [
            ['name' => 'Sentencia definitiva.pdf', 'meta' => 'v2 final · 2,4 MB'], ['name' => 'Demanda civil.pdf', 'meta' => 'v1 radicada · 1,8 MB'], ['name' => 'Poder judicial.pdf', 'meta' => 'Auténtico · 680 KB'],
        ]], 50);
        $this->section($page, 'producto.reminders', 'No pierda fechas importantes', 'Alertas preventivas para audiencias, plazos perentorios, traslados y solicitudes de antecedentes.', ['items' => [
            ['when' => 'Urgente · Hoy 15:00', 'title' => 'Revisar resolución', 'description' => 'Vencimiento fatal para deducir reposición.'], ['when' => 'Mañana 09:30', 'title' => 'Audiencia de conciliación', 'description' => 'Comparecencia telemática ante 2° Juzgado Civil.'], ['when' => 'En 3 días', 'title' => 'Solicitud de peritaje contable', 'description' => 'Remitir cartolas firmadas al perito designado.'],
        ]], 60);
        $this->section($page, 'producto.finances', 'Control financiero asociado a cada causa', 'Administre ingresos, egresos judiciales, honorarios y depósitos de peritajes para mantener una visión financiera consolidada.', ['metrics' => [
            ['label' => 'Saldo operativo consolidado', 'value' => '$28.450.000'], ['label' => 'Monto total demandado', 'value' => '$237.650.000'], ['label' => 'Egresos del período', 'value' => '$6.210.000'], ['label' => 'Recuperos e ingresos', 'value' => '$34.660.000'],
        ]], 70);
        $this->section($page, 'producto.dashboard', 'Información para apoyar la toma de decisiones', 'Métricas en tiempo real sobre carga de abogados, estado procesal y exposición financiera.', ['metrics' => [['label' => 'Causas en sistema', 'value' => '128'], ['label' => 'Vigentes', 'value' => '73%'], ['label' => 'Cerradas', 'value' => '27%']], 'workload' => [['name' => 'M. Castro', 'value' => 88], ['name' => 'A. Valenzuela', 'value' => 64], ['name' => 'C. Rivas', 'value' => 42]]], 80);
        $this->section($page, 'producto.audit', 'Trazabilidad de las modificaciones', 'SLAD permite conocer quién realizó una modificación, qué cambió, valores anteriores, valores nuevos, fecha y hora exacta.', ['rows' => [
            ['date' => '10/09/2026 11:24', 'user' => 'Mario Castro', 'matter' => 'C-1234-2025', 'change' => 'Estado procesal'], ['date' => '09/09/2026 16:10', 'user' => 'Álvaro Valenzuela', 'matter' => 'C-1234-2025', 'change' => 'Monto demandado'], ['date' => '08/09/2026 09:12', 'user' => 'Admin Sistema', 'matter' => 'O-4609-2026', 'change' => 'Reasignación titular'],
        ]], 90);
        $this->section($page, 'producto.permissions', 'Cada usuario accede únicamente a lo que necesita', 'Esquemas de privilegios adaptados a la jerarquía de su equipo legal.', ['items' => [
            ['title' => 'Administrador', 'description' => 'Acceso global, parametrización, configuración y auditoría completa.', 'features' => ['Alta y baja de usuarios', 'Reportes agregados', 'Exportación de registros']], ['title' => 'Abogado / Funcionario', 'description' => 'Gestión de causas asignadas, actuaciones, documentos y recordatorios.', 'features' => ['Causas propias o de su grupo', 'Ingreso de escritos', 'Registro de gastos']], ['title' => 'Consulta / Auditor', 'description' => 'Acceso de solo lectura conforme a permisos específicos.', 'features' => ['Revisión sin edición', 'Descarga segura', 'Resúmenes ejecutivos']],
        ]], 100);
        $this->section($page, 'producto.import', 'Migre información existente', 'Incorpore información histórica desde Excel o CSV para transitar desde planillas dispersas hacia una plataforma centralizada.', ['eyebrow' => 'Transición fluida', 'detail' => 'Mapeador asistido de columnas'], 110);
        $this->section($page, 'producto.multicompany', 'Preparado para diferentes organizaciones', 'Implemente SLAD en empresas, filiales o divisiones manteniendo la información separada y adaptada a cada estructura.', ['eyebrow' => 'Multiempresa corporativa', 'items' => ['Holding / Filial Norte', 'División Inmobiliaria', 'Servicios Financieros', 'Sociedad Concesionaria']], 120);
        $this->section($page, 'producto.security', 'Protección de la información', 'Salvaguardamos la confidencialidad procesal mediante protocolos corporativos estandarizados.', ['items' => [
            ['title' => 'Autenticación segura', 'description' => 'Soporte multifactor y estándares corporativos.'], ['title' => 'Roles granulares', 'description' => 'Permisos diferenciados por función.'], ['title' => 'Separación estricta', 'description' => 'Aislamiento de información por organización.'], ['title' => 'Protección de documentos', 'description' => 'Almacenamiento con control de integridad.'], ['title' => 'Auditoría continua', 'description' => 'Registro permanente de eventos y accesos.'], ['title' => 'Conexión cifrada HTTPS', 'description' => 'Canales seguros punto a punto.'], ['title' => 'Respaldos periódicos', 'description' => 'Copias automatizadas y pruebas de restauración.'], ['title' => 'Acceso basado en políticas', 'description' => 'Reglas de sesión y privilegios.'],
        ]], 130);
        $this->section($page, 'producto.cta', 'Solicite una demostración de SLAD', 'Conozca cómo SLAD centraliza el ciclo integral de sus causas, reduce el riesgo de preclusión y optimiza la productividad jurídica.', ['button' => 'Solicitar demostración'], 140);
    }

    private function seedAbout(): void
    {
        $page = Page::query()->where('slug', 'nosotros')->firstOrFail();

        $this->section($page, 'nosotros.hero', 'Tecnología aplicada a una gestión jurídica más organizada', 'SLAD nace con el objetivo de simplificar la administración de información jurídica y transformar procesos que tradicionalmente dependen de planillas, documentos dispersos y controles manuales.', ['eyebrow' => 'Institucional · Trayectoria · Rigor', 'metrics' => [
            ['label' => 'Trazabilidad integral', 'value' => '100%', 'detail' => 'Registro inmutable de actuaciones y accesos'], ['label' => 'Mitigación de errores', 'value' => '−85%', 'detail' => 'Disminución en traspapeleo y plazos vencidos'], ['label' => 'Eficiencia operativa', 'value' => '3.5x', 'detail' => 'Mayor celeridad en auditorías'], ['label' => 'Seguridad por roles', 'value' => 'RBAC', 'detail' => 'Gobernanza de expedientes confidenciales'],
        ]], 10);
        $this->section($page, 'nosotros.purpose', 'Nuestro propósito', 'Ayudar a organizaciones y equipos jurídicos a disponer de información centralizada, trazable y accesible, facilitando el seguimiento de sus causas y la toma de decisiones.', ['eyebrow' => 'Fundamento corporativo', 'traits' => ['Rigor profesional', 'Orden institucional', 'Modernización del derecho']], 20);
        $this->section($page, 'nosotros.vision', 'Nuestra visión', 'Desarrollar herramientas simples y confiables que permitan modernizar la gestión jurídica sin agregar complejidad innecesaria al trabajo diario.', ['eyebrow' => 'Dirección estratégica', 'note' => 'Tecnología sobria diseñada para el ritmo real de juzgados y fiscalías corporativas.'], 30);
        $this->section($page, 'nosotros.values', 'Nuestros Principios', 'Estándares rectores que definen la arquitectura de software, la experiencia de usuario y la salvaguarda de la información jurídica.', ['eyebrow' => 'Pilares operativos', 'items' => [
            ['number' => '01', 'title' => 'Simplicidad', 'description' => 'Las herramientas deben facilitar el trabajo, no dificultarlo. Interfaces claras para adopción desde el primer día.', 'tag' => 'Enfoque pragmático'], ['number' => '02', 'title' => 'Trazabilidad', 'description' => 'La información debe permitir conocer qué ocurrió, cuándo y quién realizó cada acción.', 'tag' => 'Bitácora cronológica'], ['number' => '03', 'title' => 'Seguridad', 'description' => 'El acceso debe estar controlado según las responsabilidades de cada usuario.', 'tag' => 'Control de privilegios'], ['number' => '04', 'title' => 'Evolución', 'description' => 'Una arquitectura modular preparada para nuevos volúmenes y marcos regulatorios.', 'tag' => 'Escalabilidad corporativa'],
        ]], 40);
        $this->section($page, 'nosotros.approach', 'Diseñado pensando en la gestión real', 'La práctica jurídica no ocurre en silos. SLAD reúne en una sola plataforma los ejes esenciales del ejercicio profesional, reduciendo riesgos y otorgando visibilidad a jefaturas y equipos jurídicos.', ['note' => 'Centralizar previene la asimetría de antecedentes y minimiza la dependencia de personas específicas para el traspaso de información.', 'items' => ['Causas', 'Responsables', 'Documentos', 'Actuaciones', 'Finanzas', 'Recordatorios', 'Estadísticas & Métricas']], 50);
        $this->section($page, 'nosotros.cta', '¿Quiere conocer SLAD?', 'Conversemos sobre las necesidades de su organización y cómo estructurar un flujo jurídico trazable, seguro y eficiente.', ['button' => 'Contactar', 'response' => 'Respuesta en menos de 24 hrs'], 60);
    }

    private function seedContact(): void
    {
        $page = Page::query()->where('slug', 'contacto')->firstOrFail();

        $this->section($page, 'contacto.hero', 'Conversemos sobre su gestión jurídica', 'Solicite una demostración de SLAD o cuéntenos qué necesita su organización. Nuestro equipo de implementación legal le acompañará paso a paso.', ['eyebrow' => 'Atención corporativa B2B'], 10);
        $this->section($page, 'contacto.form', 'Agende una Sesión Técnica', 'Complete el formulario y le contactaremos en menos de 24 horas hábiles.', ['needs' => ['Causas', 'Actuaciones', 'Documentos', 'Recordatorios', 'Gestión financiera', 'Importación Excel', 'Otro alcance'], 'privacy' => 'Nos pondremos en contacto para conocer sus necesidades y mostrarle cómo SLAD puede adaptarse a su organización.'], 20);
        $this->section($page, 'contacto.information', 'Contacto directo', 'Canales de atención comercial y operativa.', ['email_sales' => 'contacto@slad.la', 'email_support' => 'soporte@slad.la', 'phone' => '+56 (2) 2800 4500', 'hours' => 'Lunes a Viernes de 08:30 a 18:30 (GMT−4)', 'location' => 'Santiago, Chile', 'coverage' => 'Cobertura operativa en Latinoamérica', 'confidentiality' => 'Toda interacción previa y documentación compartida para pruebas de concepto se maneja bajo estrictos protocolos de confidencialidad.'], 30);
        $this->section($page, 'contacto.cta', 'SLAD — Sistema Logístico de Administración de Derecho', 'Una plataforma para centralizar, organizar y dar seguimiento a la gestión jurídica corporativa con trazabilidad ininterrumpida.', ['eyebrow' => 'Arquitectura SaaS especializada', 'items' => ['Causas & Dockets', 'Plazos fatales', 'Actuaciones cloud', 'Reportes KPI']], 40);
    }

    private function seedSettings(): void
    {
        $settings = [
            ['site_name', 'SLAD', 'Nombre del sitio', 'general'], ['site_tagline', 'Sistema Logístico de Administración de Derecho', 'Descripción de marca', 'general'], ['logo_path', null, 'Ruta del logotipo en la biblioteca multimedia', 'marca'], ['favicon_path', null, 'Ruta del favicon en la biblioteca multimedia', 'marca'], ['contact_email', 'contacto@slad.la', 'Correo comercial', 'contacto'], ['support_email', 'soporte@slad.la', 'Correo de soporte', 'contacto'], ['phone', '+56 (2) 2800 4500', 'Teléfono', 'contacto'], ['location', 'Santiago, Chile', 'Ubicación', 'contacto'], ['business_hours', 'Lunes a Viernes de 08:30 a 18:30 (GMT−4)', 'Horario', 'contacto'], ['copyright', '© 2026 SLAD. Todos los derechos reservados. Software propietario.', 'Copyright', 'general'], ['footer_note', 'Gestión Jurídica y Cumplimiento Corporativo', 'Nota del pie', 'general'],
        ];

        foreach ($settings as [$key, $value, $label, $group]) {
            SiteSetting::query()->updateOrCreate(['key' => $key], compact('value', 'label', 'group'));
        }
    }

    /** @param array<string, mixed> $content */
    private function section(Page $page, string $key, ?string $title, ?string $subtitle, array $content, int $order): void
    {
        $page->sections()->updateOrCreate(
            ['section_key' => $key],
            ['title' => $title, 'subtitle' => $subtitle, 'content' => $content, 'sort_order' => $order, 'is_active' => true],
        );
    }
}
