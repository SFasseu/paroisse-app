# Module Gestion des Sacrements
## Paroisse Saint-Esprit de Bépanda — Archidiocèse de Douala

> Version 1.0 — Février 2026  
> Développé pour le projet de digitalisation de la Paroisse Saint-Esprit de Bépanda.

---

## 📋 Contenu du Module

Ce module ajoute la gestion complète des sacrements et de la catéchèse au projet Laravel existant :

- **11 migrations** de base de données
- **10 Models** Eloquent
- **9 Controllers** dans `App\Http\Controllers\Sacrements\`
- **5 Seeders** de données de démo
- **30+ vues Blade** avec layout dédié
- Routes protégées par middleware `auth`

---

## 🚀 Installation étape par étape

### Étape 1 — Extraire les fichiers

Extraire le contenu du ZIP à la **racine du projet Laravel** :

```bash
unzip sacrements_module.zip -d /chemin/vers/votre/projet/
```

La structure sera fusionnée avec votre projet existant. **Aucun fichier existant ne sera écrasé.**

### Étape 2 — Ajouter les routes

Ouvrir le fichier `routes/web.php` et copier-coller le contenu du fichier `routes_sacrements.txt` **à la fin du fichier**, après toutes les routes existantes.

> ⚠️ Assurez-vous d'ajouter les `use` statements en haut du fichier `web.php`, ou de les inclure dans la zone des imports existants.

### Étape 3 — Exécuter les migrations

```bash
php artisan migrate
```

Cela créera les 11 nouvelles tables dans votre base de données.

### Étape 4 — Charger les données de démo

Exécuter les seeders dans cet ordre :

```bash
php artisan db:seed --class=NiveauFormationSeeder
php artisan db:seed --class=CoursSeeder
php artisan db:seed --class=ExamenSeeder
php artisan db:seed --class=GroupeAndCatechisteSeeder
php artisan db:seed --class=CatechumeneSeeder
```

Ou les appeler depuis `DatabaseSeeder.php` :

```php
// Dans database/seeders/DatabaseSeeder.php, méthode run() :
$this->call([
    NiveauFormationSeeder::class,
    CoursSeeder::class,
    ExamenSeeder::class,
    GroupeAndCatechisteSeeder::class,
    CatechumeneSeeder::class,
]);
```

Puis : `php artisan db:seed`

### Étape 5 — Lien symbolique du storage

Pour les photos des catéchistes :

```bash
php artisan storage:link
```

### Étape 6 — Accéder au module

1. Se connecter à l'application sur `/login`
2. Naviguer vers `/sacrements`
3. Le tableau de bord du module s'affichera

---

## 🗃️ Structure des tables créées

| Table | Description |
|-------|-------------|
| `niveaux_formation` | Niveaux du parcours catéchétique |
| `cours` | Matières/leçons par niveau |
| `examens` | Évaluations liées aux niveaux |
| `groupes_catechese` | Groupes de catéchumènes |
| `catechistes` | Animateurs/enseignants |
| `groupe_catechese_catechiste` | Pivot groupes ↔ catéchistes |
| `catechumenes` | Dossiers individuels |
| `parents_tuteurs` | Parents et tuteurs |
| `progressions_catechumene` | Avancement par niveau |
| `resultats_examens` | Notes aux examens |
| `sacrements` | Sacrements reçus |

---

## 🎨 Charte graphique

| Élément | Couleur |
|---------|---------|
| Primaire (navbar, titres) | `#1A3A6B` (bleu marine) |
| Accent (badges sacrements) | `#C0392B` (rouge feu) |
| Fond clair | `#F0F4FF` |

---

## 🔐 Sécurité

- Toutes les routes sont protégées par `middleware('auth')`
- Validation stricte sur tous les formulaires
- Uploads sécurisés (mimes, taille max 2 Mo)
- Protection CSRF sur tous les formulaires

---

## 📁 Structure des fichiers ajoutés

```
app/
├── Http/Controllers/Sacrements/
│   ├── SacrementsController.php        ← Dashboard
│   ├── NiveauFormationController.php
│   ├── CoursController.php
│   ├── ExamenController.php
│   ├── GroupeCatecheseController.php
│   ├── CatechisteController.php
│   ├── CatechumeneController.php       ← Controller principal
│   ├── ProgressionController.php
│   └── SacrementRecuController.php
└── Models/
    ├── NiveauFormation.php
    ├── Cours.php
    ├── Examen.php
    ├── GroupeCatechese.php
    ├── Catechiste.php
    ├── Catechumene.php                 ← Model principal (avec boot)
    ├── ParentTuteur.php
    ├── ProgressionCatechumene.php
    ├── ResultatExamen.php
    └── Sacrement.php

database/
├── migrations/
│   ├── 2026_03_01_000001_create_niveaux_formation_table.php
│   ├── 2026_03_01_000002_create_cours_table.php
│   ├── 2026_03_01_000003_create_examens_table.php
│   ├── 2026_03_01_000004_create_groupes_catechese_table.php
│   ├── 2026_03_01_000005_create_catechistes_table.php
│   ├── 2026_03_01_000006_create_groupe_catechese_catechiste_table.php
│   ├── 2026_03_01_000007_create_catechumenes_table.php
│   ├── 2026_03_01_000008_create_parents_tuteurs_table.php
│   ├── 2026_03_01_000009_create_progressions_catechumene_table.php
│   ├── 2026_03_01_000010_create_resultats_examens_table.php
│   └── 2026_03_01_000011_create_sacrements_table.php
└── seeders/
    ├── NiveauFormationSeeder.php
    ├── CoursSeeder.php
    ├── ExamenSeeder.php
    ├── GroupeAndCatechisteSeeder.php
    └── CatechumeneSeeder.php

resources/views/sacrements/
├── layouts/sacrements.blade.php       ← Layout principal avec sidebar
├── dashboard.blade.php
├── niveaux/ (5 vues)
├── cours/ (4 vues)
├── examens/ (5 vues dont saisir-resultats)
├── groupes/ (4 vues)
├── catechistes/ (4 vues)
├── catechumenes/ (5 vues dont show complet)
└── sacrements/ (2 vues)
```

---

## ⚙️ Données de démo incluses

Après les seeders, vous aurez :
- **5 niveaux** de formation (Éveil à la foi → Formation continue)
- **18 cours** répartis sur les 5 niveaux
- **9 examens** (1-2 par niveau)
- **2 catéchistes** de démo
- **2 groupes** de catéchèse
- **10 catéchumènes** avec prénoms camerounais, répartis dans les groupes
- Des progressions et résultats d'examens de démo

---

## 🆘 Support

Ce module a été développé dans le cadre du projet de digitalisation de la **Paroisse Saint-Esprit de Bépanda**, Archidiocèse de Douala, Cameroun — 2026.
