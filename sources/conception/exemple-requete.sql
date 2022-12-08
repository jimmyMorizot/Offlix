--Récupèrer tous les films
SELECT * FROM movie

-- Récupèrer les acteurs et leurs rôles pour un film donné
SELECT * FROM person
INNER JOIN casting ON casting.person_id = person.id
INNER JOIN movie ON movie.id = casting.movie_id
WHERE movie.title = 'Epic Movie'

-- Récupérer les genres associés à un film donné
SELECT name FROM genre
INNER JOIN movie.genre ON movie.genre.genre.id = genre.id
INNER JOIN movie ON movie_genre.movie_id = movie.id
WHERE title = 'Epic Movie'

-- Récupérer les saisons associées à un film/série donné
SELECT * FROM season
INNER JOIN movie ON movie.id = season.movie_id
WHERE movie.title = 'Epic Movie'

-- Récupérer les critiques pour un film donné
SELECT * FROM review 
INNER JOIN movie ON review.movie_id = movie.id 
WHERE movie.title = 'Epic movie'

-- Récupérer les critiques pour un film donné, ainsi que le nom de l'utilisateur associé
SELECT movie.title, review.rating, user.email FROM review
INNER JOIN movie ON review.movie_id = movie.id
INNER JOIN user ON review.user_id = user.id
WHERE movie.title = 'Epic Movie'

-- Calculer, pour chaque film, la moyenne des critiques par film (en une seule requête)
SELECT title, ROUND(AVG(review.rating),1) AS moyenne
FROM movie
INNER JOIN review ON movie.id = review.movie_id
GROUP BY title

-- Idem pour un film donné
SELECT title, ROUND(AVG(review.rating),1) AS moyenne
FROM movie
INNER JOIN review ON movie.id = review.movie_id
WHERE movie.title = 'The Jungle Book'

-- Récupérer tous les films pour une année de sortie donnée (2014)
SELECT * FROM movie 
WHERE YEAR(release_date) = '2014';

-- Récupérer tous les films pour un titre donné (par ex. 'Epic Movie')
SELECT * FROM movie
WHERE title = 'Epic Movie'

-- Récupérer tous les films dont le titre contient une chaîne donnée
SELECT * FROM movie
WHERE title  LIKE '%the%'

-- Récupérer la liste des films de la page 2 (grâce à LIMIT)
-- Testez la requête en faisant varier le nombre de films par page et le numéro de page
SELECT * 
FROM movie
LIMIT 10
OFFSET 10


