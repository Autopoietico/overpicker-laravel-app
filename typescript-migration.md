# Migración a TypeScript — Paso a paso

---

## PASO 0 — Configuración (hacer esto UNA sola vez antes de empezar)

### 1. Instalar TypeScript

```bash
npm install --save-dev typescript
```

### 2. Crear `tsconfig.json` en la raíz del proyecto

```json
{
    "compilerOptions": {
        "target": "ES2020",
        "module": "ESNext",
        "moduleResolution": "bundler",
        "strict": true,
        "lib": ["ES2020", "DOM"],
        "noEmit": true,
        "skipLibCheck": true
    },
    "include": ["resources/js/**/*.ts"]
}
```

### 3. Actualizar `vite.config.js`

Agregar los dos entry points nuevos:

```js
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/calculator.ts",
                "resources/js/hamburger.ts",
            ],
            refresh: true,
        }),
    ],
});
```

### 4. Actualizar las Blade views

En `resources/views/calculator.blade.php` (~línea 70):

```html
<!-- Cambiar esto: -->
<script defer src="js/calculator.js" type="module"></script>

<!-- Por esto: -->
@vite('resources/js/calculator.ts')
```

En `resources/views/components/home/header.blade.php` (~línea 44):

```html
<!-- Cambiar esto: -->
<script defer src="js/hamburger.js"></script>

<!-- Por esto: -->
@vite('resources/js/hamburger.ts')
```

### 5. Crear las carpetas en `resources/js/`

```
resources/js/
├── utils/
├── api/
├── models/
├── views/
└── controllers/
```

---

## REGLA IMPORTANTE

Puedes migrar los archivos de uno en uno. Vite puede importar `.js` desde un archivo `.ts`.
Pero siempre migra **las dependencias antes** que los archivos que las usan.

---

## ORDEN DE MIGRACIÓN

Cada archivo: cópialo de `public/js/` a `resources/js/`, renómbralo a `.ts`, y corrígelo.

---

### Archivo 1 — `utils/constants.ts`

- **Original:** `public/js/utils/constants.js` (67 líneas)
- **Destino:** `resources/js/utils/constants.ts`
- **Conceptos TypeScript:**
    - Tipar el retorno de una función: `function getSelectValue(value: string): string`
    - Exportar constantes con tipos inferidos
- **Dependencias:** ninguna

---

### Archivo 2 — `models/model-map.ts`

- **Original:** `public/js/models/model-map.js` (19 líneas)
- **Destino:** `resources/js/models/model-map.ts`
- **Conceptos TypeScript:**
    - Tu primera clase tipada
    - Propiedades con tipos: `name: string`, `onPool: boolean`, `points: string[]`
- **Dependencias:** ninguna

---

### Archivo 3 — `models/model-map-type.ts`

- **Original:** `public/js/models/model-map-type.js` (25 líneas)
- **Destino:** `resources/js/models/model-map-type.ts`
- **Conceptos TypeScript:** Igual que model-map, refuerzo de clases simples
- **Dependencias:** ninguna

---

### Archivo 4 — `models/model-tier.ts`

- **Original:** `public/js/models/model-tier.js` (35 líneas)
- **Destino:** `resources/js/models/model-tier.ts`
- **Conceptos TypeScript:** Refuerzo de clases con constructor tipado
- **Dependencias:** ninguna

---

### Archivo 5 — `hamburger.ts`

- **Original:** `public/js/hamburger.js` (28 líneas)
- **Destino:** `resources/js/hamburger.ts`
- **Conceptos TypeScript:**
    - `document.getElementById()` devuelve `HTMLElement | null` — hay que manejarlo
    - Optional chaining: `elemento?.classList.toggle('clase')`
    - Type assertion: `elemento as HTMLElement` cuando sabes que existe
- **Dependencias:** ninguna

---

### Archivo 6 — `api/model-api.ts`

- **Original:** `public/js/api/model-api.js` (188 líneas)
- **Destino:** `resources/js/api/model-api.ts`
- **Conceptos TypeScript:**
    - `interface` para tipar los datos JSON que llegan de la API
    - `fetch` con tipo de retorno: `Promise<HeroInfo[]>`
    - `localStorage.getItem()` devuelve `string | null`
- **Dependencias:** `utils/constants.ts` (actualiza ese import)

---

### Archivo 7 — `models/model-hero.ts`

- **Original:** `public/js/models/model-hero.js` (348 líneas)
- **Destino:** `resources/js/models/model-hero.ts`
- **Conceptos TypeScript:**
    - Clases con muchas propiedades tipadas
    - Tipos de unión: `number | null`
    - Tipar parámetros de métodos complejos como `calcScore()`
- **Dependencias:** `utils/constants.ts`

---

### Archivo 8 — `models/model-team.ts`

- **Original:** `public/js/models/model-team.js` (321 líneas)
- **Destino:** `resources/js/models/model-team.ts`
- **Conceptos TypeScript:**
    - Array de clases: `heroes: ModelHero[]`
    - Métodos que devuelven objetos tipados
    - Importar y usar otra clase TS
- **Dependencias:** `models/model-hero.ts`

---

### Archivo 9 — `views/view-overpicker.ts`

- **Original:** `public/js/views/view-overpicker.js` (1301 líneas)
- **Destino:** `resources/js/views/view-overpicker.ts`
- **Conceptos TypeScript:**
    - Tipos específicos de DOM: `HTMLInputElement`, `HTMLSelectElement`, `HTMLDivElement`
    - Callbacks tipados como propiedades de clase
    - `addEventListener` con tipos de evento
- **Tip:** Es el archivo más grande pero muy repetitivo. Empieza por los métodos cortos
  como `displayTeamScores()` y ve avanzando.
- **Dependencias:** `utils/constants.ts`

---

### Archivo 10 — `models/model-overpicker.ts`

- **Original:** `public/js/models/model-overpicker.js` (849 líneas)
- **Destino:** `resources/js/models/model-overpicker.ts`
- **Conceptos TypeScript:**
    - El modelo más complejo de la app
    - Tipar funciones como propiedades de clase (callbacks/observers):
        ```ts
        onOptionChange: ((option: string, value: boolean) => void) | null = null;
        ```
    - Clases que usan otras clases tipadas como dependencias
- **Dependencias:** todos los modelos anteriores + `api/model-api.ts` + `utils/constants.ts`

---

### Archivo 11 — `controllers/controller-overpicker.ts`

- **Original:** `public/js/controllers/controller-overpicker.js` (156 líneas)
- **Destino:** `resources/js/controllers/controller-overpicker.ts`
- **Conceptos TypeScript:**
    - Inyección de dependencias tipada en el constructor
    - TypeScript garantiza que solo puedes llamar métodos que existen en `ModelOverPicker` y `ViewOverPicker`
- **Dependencias:** `models/model-overpicker.ts`, `views/view-overpicker.ts`

---

### Archivo 12 — `calculator.ts` ← LLEGADA

- **Original:** `public/js/calculator.js` (32 líneas)
- **Destino:** `resources/js/calculator.ts`
- **Conceptos TypeScript:** Solo imports — si este compila, la migración está completa
- **Dependencias:** todos los anteriores

---

## VERIFICACIÓN CONTINUA

Después de cada archivo, ejecuta esto para ver errores de tipos sin correr el browser:

```bash
npx tsc --noEmit
```

Y para ver los cambios en el browser:

```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

---

## LIMPIEZA FINAL (solo al terminar los 12 archivos)

Una vez que todo funcione, puedes borrar la carpeta `public/js/` entera — ya no se usa.
