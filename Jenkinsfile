properties([pipelineTriggers([githubPush()])])

pipeline {
    agent any

    stages {

        stage('Create test container') {
            steps {
                sh '''
                    echo Creating Test Container...
                    docker run -d --name movie_listing-test\
                    -v /home/guille/dockers/jenkins/volumes/home/workspace/movie_listing-pipeline-push_github:/var/www/html \
                    -w /var/www/html \
                    movie_listing
                '''
            }
        }

        stage('Build') {
            steps {
                sh '''
                    echo Building...
                    docker exec -u jenkins movie_listing-test composer install
                    docker exec movie_listing-test /bin/chown -R www-data:www-data /var/www/html/storage
                    docker exec movie_listing-test /bin/chmod -R 755 /var/www/html/storage
                '''
            }
        }

        stage('Test') {
            steps {
                sh '''
                    echo Testing...
                    ll
                '''
            }
        }

        stage('Push') {
            steps {
                sh 'echo Pushing image to Dockerhub...'
            }
        }

        stage('Deploy') {
            steps {
                sh 'echo Deploying image in Prod...'
            }
        }
    }
}