pipeline {
    agent any

    stages {

        stage('Build') {
            steps {
                sh '''
                    echo Building...
                    docker run \
                    -v /var/jenkins_home/workspace/movie_listing-pipeline-push_github:/var/www/html \
                    -w /var/www/html \
                    --name movie_listing-test \
                    registry/movie_listing
                '''
            }
        }

        stage('Test') {
            steps {
                sh 'echo Testing...'
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