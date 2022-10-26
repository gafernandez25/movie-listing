properties([pipelineTriggers([githubPush()])])

pipeline {
    agent any

    environment {
        dockerRegistryPort = 5000
    }

    stages {

        stage('Create test container') {
            steps {
                sh '''
                    docker run -d --name movie_listing-test\
                    -v /home/guille/dockers/jenkins/volumes/home/workspace/movie_listing-pipeline-push_github:/tmp/source_code \
                    -w /var/www/html \
                    localhost:${dockerRegistryPort}/movie_listing

                    docker exec movie_listing-test rm -f index.html
                    docker exec movie_listing-test /bin/chown -R jenkins:jenkins /var/www/html
                '''
            }
        }

        stage('Build') {
            steps {
                sh '''
                    docker exec -u jenkins movie_listing-test cp -R /tmp/source_code/. /var/www/html
                    docker exec -u jenkins movie_listing-test composer install
                '''
            }
        }

        stage('Test') {
            steps {
                sh '''
                    docker exec -u jenkins movie_listing-test ./vendor/bin/phpunit
                '''
            }
        }

        stage('Push') {
            steps {
                sh '''
                docker commit movie_listing-test movie_listing-prod:${BUILD_NUMBER}
                docker tag movie_listing-prod:${BUILD_NUMBER} localhost:${dockerRegistryPort}/movie_listing-prod:${BUILD_NUMBER}
                docker push localhost:${dockerRegistryPort}/movie_listing-prod:${BUILD_NUMBER}
                '''
            }
        }

        stage('Deploy') {
            steps {
                sh '''
                docker run -d --name movie_listing-prod -p 4362:443 -p 862:80 --network dockers_guille \
                localhost:${dockerRegistryPort}/movie_listing-prod:${BUILD_NUMBER}
                '''
            }
        }
    }


}