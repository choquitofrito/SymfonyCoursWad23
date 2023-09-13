# Git Reset: guide de base


Git offre plusieurs moyens de revenir en arrière dans l'historique d'un dépôt. L'une des commandes les plus couramment utilisées pour cela est `git reset`. Voici un guide sur les différentes façons d'utiliser `git reset` avec des exemples.

**1. `git reset --soft` : Annuler le dernier commit**

Utilisez cette option pour annuler le dernier commit tout en conservant les modifications dans votre zone de préparation (staging). Cela vous permet de réviser vos modifications avant de créer un nouveau commit.

```bash
# Annuler le dernier commit tout en conservant les modifications dans la zone de préparation
git reset --soft HEAD~1
```

**2. `git reset --mixed` (ou simplement `git reset`) : Annuler le dernier commit et déplacer les modifications dans le répertoire de travail**

Cette option annule le dernier commit et place les modifications dans le répertoire de travail, sans les perdre complètement. Vous devrez réajouter les modifications à la zone de préparation pour les inclure dans un nouveau commit.

```bash
# Annuler le dernier commit et déplacer les modifications dans le répertoire de travail
git reset HEAD~1
```

**3. `git reset --hard` : Annuler le dernier commit et supprimer toutes les modifications**

Utilisez cette option si vous souhaitez annuler complètement le dernier commit et supprimer toutes les modifications associées.

```bash
# Annuler le dernier commit et supprimer toutes les modifications
git reset --hard HEAD~1
```

**4. `git reset <commit>` : Revenir à un commit spécifique**

Vous pouvez également utiliser `git reset` pour revenir à un commit spécifique en spécifiant son identifiant SHA-1. Cela déplacera votre branche actuelle vers ce commit, en supprimant tous les commits situés après.

```bash
# Revenir à un commit spécifique (remplacez <commit> par le SHA-1 du commit souhaité)
git reset <commit>
```

**5. `git reset --mixed <commit>` : Revenir à un commit spécifique et conserver les modifications dans le répertoire de travail**

Cela revient à un commit spécifique tout en conservant les modifications dans le répertoire de travail, vous permettant de réévaluer vos modifications avant de les ajouter à la zone de préparation.

```bash
# Revenir à un commit spécifique et conserver les modifications dans le répertoire de travail
git reset --mixed <commit>
```

**6. `git reset --hard <commit>` : Revenir à un commit spécifique et supprimer toutes les modifications**

Utilisez cette option pour revenir à un commit spécifique et supprimer toutes les modifications, y compris celles dans le répertoire de travail.

```bash
# Revenir à un commit spécifique et supprimer toutes les modifications
git reset --hard <commit>
```

Assurez-vous de faire attention lorsque vous utilisez `git reset --hard`, car cela peut entraîner la perte permanente de modifications non sauvegardées. Il est recommandé de créer une copie de sauvegarde de votre travail avant d'utiliser cette option.

Utilisez ces commandes avec précaution, en gardant à l'esprit que la modification de l'historique Git peut avoir un impact sur la collaboration avec d'autres développeurs.
