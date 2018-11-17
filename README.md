# Baustelle

![Baustelle](./web/beinehoch.svg)

Dieses Repository enthält alle Informationen, um schnell und unkompliziert eine Wartungsseite als Ersatz für eine andere Website in einer Docker-Umgebung hochzuziehen.

Angenommen, es läuft ein [Antragsgrün / motion.tool](https://github.com/jugendpresse/docker-antragsgruen/) Docker-Container `motiontool` mit der URL `https://motiontool.jugendpresse.de` hinter einem Træfik-Reverseproxy im Docker-Netzwerk `proxy`, kann dieser Befehl die Standard-Wartungsseite als Ersatz für den aktuellen Container starten:

```sh
docker stop motiontool
docker run --detach \
  --name motiontool_maintenance \
  --restart unless-stopped \
  --label traefik.frontend.rule="Host:motiontool.jugendpresse.de" \
  --label traefik.frontend.entryPoints=http \
  --label traefik.docker.network=proxy \
  --label traefik.backend="Wartungsseite" \
  --label traefik.port=80 \
  jugendpresse/baustelle
```

Folgende Umgebungsvariablen (zusätzlich zu den [Apache-Variablen](https://github.com/jugendpresse/docker-apache#environmental-variables)) stehen zur Verfügung und können das Erscheinungsbild verändern:

| env                   | mandatory in `.env` | default               | description |
| --------------------- |:-------------------:| --------------------- | ----------- |
| `REASON`              | yes                 | Baustelle             | |
| `EXPLAIN`             | yes                 | Hier wird alles besser ... | |
| `PARAGRAPH`           | yes                 | ... das haben wir uns zumindest vorgenommen; aus diesem Grund finden gerade Wartungsarbeiten statt.<br/><br/>Also: Beine hoch und mal wieder eine Zeitung lesen &ndash; wir sind bald wieder da =) | |
| `HEAD`                | no                  | `NAN`                 | HTML-code to be appended to the HTML `<head>` |
| `PREPEND`             | no                  | `NAN`                 | HTML-code to be prepended to the HTML `<body>` |
| `APPEND`              | no                  | `NAN`                 | HTML-code to be appended to the HTML `<body>` |

Umgebungsvariablen können entweder dem Container im `docker run` Befehl mit dem Parameter `-e` übergeben – oder aber in einer `.env` Datei definiert werden, die dann im Container als Mount in den Pfad `/var/www/html/.env` verfügbar gemacht werden muss. Wird eine `.env`-Datei definiert, müssen die in der Tabelle markierten Umgebungsvariablen definiert werden, da anderenfalls die Wartungsseite (fast) leer dargestellt wird.


<style>
	img[alt=Baustelle] {
		width: 150px;
	}
</style>
