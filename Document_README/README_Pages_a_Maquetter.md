## Tableau maquettes Desktop / Mobile

Mobile : usage personnel.
Page	                    Desktop	          Mobile	                Priorité	   Figma / Maquettage	   User Story	                       Controller Symfony
---------------------------|-----------------|-------------------------|--------------|-----------------------|---------------------------------|---------------------------
Connexion	                ✅	            ✅ (optionnel)	         Haute	         Maquetter	             US01: Connexion utilisateur	  SecurityController::login()
Mdp oublié/réinitialisation ✅	            ✅ (optionnel)	         Moyenne	     Maquette simplifié	     US02: Réinitialisation mdp       SecurityController::resetPassword()
Dashboard Agent	            ✅	            ✅ (optionnel)	         Haute	         Maquette complet	     US03: Vue agent	              DashboardController::agent()
Mes informations RH	        ✅	            ✅ (optionnel)	         Moyenne	     Wireframe simple	     US04: Profil agent	              ProfileController::edit()
Dashboard Gestionnaire RH	✅	            ✅ (optionnel)	         Haute	         Maquette complet	     US07: Vue gestionnaire	          DashboardController::manager()
Dashboard Administrateur	✅	            ✅ (optionnel)	         Haute	         Maquetter complet	     US10: Vue admin	              DashboardController::admin()
Gestion des utilisateurs	✅	            ✅ (optionnel)	         Moyenne	     Wireframe simple	     US11: CRUD utilisateurs	      UserController::index(), UserController::edit()
Gest° rôles & permissions	✅	            ❌	                     Moyenne	     Wireframe simple	     US12: Roles & permissions	      RoleController::index()
Paramétrage général	        ✅	            ❌	                     Moyenne	     Wireframe simple	     US13: Paramétrages	              SettingsController::index()
Mentions légales / RGPD	    ✅	            ✅ (optionnel)	         Basse	         Mention simple	         US14: RGPD	                      StaticController::legal()
Pg erreur403/404 Maintenance✅	            ✅ (optionnel)	         Basse	         Mention simple	         US15: Pages erreurs	          ErrorController::error()


Règles pour Figma / Maquettage

Maquetter complet   : desktop et mobile (optionnel), détails UI/UX, couleurs, typographie, sections interactives.
Wireframe simple    : structure, disposition, navigation, design final non nécessaire.
Mention simple      : Capture ou wireframe basique



Correspondance pages ↔ User Stories ↔ Controllers Symfony
Page	                           User Story	    Controller Symfony
-------------------------------|-------------------|----------------------------
Connexion	                        US01	        SecurityController::login()
Mdp oublié/réinitialisation	        US02	        SecurityController::resetPassword()
Dashboard Agent	                    US03	        DashboardController::agent()
Mes informations RH	                US04	        ProfileController::edit()
Dashboard Gestionnaire RH	        US07	        DashboardController::manager()
Dashboard Administrateur	        US10	        DashboardController::admin()
Gestion des utilisateurs	        US11	        UserController::index(), UserController::edit()
Gestion des rôles & permissions	    US12	        RoleController::index()
Paramétrage général	                US13	        SettingsController::index()
Mentions légales / RGPD     	    US14	        StaticController::legal()
Pges erreur 403/404/Maintenance	    US15	        ErrorController::error()