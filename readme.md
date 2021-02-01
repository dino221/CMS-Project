### Install

- composer update
- php artisan key:generate
- php artisan migrate --seed

### admin panel after migrate --seed

-/admin-dashboard

- admin@seminar.com
- admin

- editor@seminar.com
- editor

- user@seminar.com
- user



//Admin moze sve vidjeti i uredivati i ne moze se obrisati
//Editor moze sve editirati
//User moze uredivati samo svoj profil


//Ako ne radi slug treba u index.blade.php dodati @if($aboutUs) @endif

// U User.php vrsilo dvostruku enkripciju pa sam obrisao dio
                                              