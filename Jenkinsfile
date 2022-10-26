properties([pipelineTriggers([githubPush()])])

pipeline {
    agent any

    environment {
        buildSuccessful = false
        test = 1
    }

    stages {

        stage('Create test container') {
            steps {
                sh '''
                    echo Creating Test Container...
                    docker run -d --name movie_listing-test\
                    -v /home/guille/dockers/jenkins/volumes/home/workspace/movie_listing-pipeline-push_github:/var/www/html \
                    -w /var/www/html \
                    localhost:5000/movie_listing
                '''
            }
            post {
                success {
                    sh 'echo build success'
                     script {
                     sh 'echo script en build success'
                        buildSuccessful = true
                        test = 200
                     }
                }
            }
        }

        stage('Build') {
            steps {
                sh '''
                    echo Building...
                    docker exec -u jenkins movie_listing-test composer install
                '''
            }
        }

        stage('Test') {
            steps {
                sh '''
                    echo Testing...
                    docker exec -u jenkins movie_listing-test ./vendor/bin/phpunit
                '''
            }
        }

        stage('Push') {
            steps {
                sh '''
                echo Pushing image to Registry...
                docker commit movie_listing-test movie_listing-test
                '''
            }
        }

        stage('Deploy') {
            steps {
                sh 'echo Deploying image in Prod...'
            }
        }
    }

    post {
        failure {
            sh 'echo Fallóóóóóóóóóó LPM'
        }
        success {
            sh 'echo Andó, vamos carajo LPM'
        }
        always{
            sh 'echo yo me ejecuto siempre'
            sh 'echo test = ${test}'
            sh 'echo ${buildSuccessful}'
            script{
                if(buildSuccessful == true){
                    sh '''
                    echo buildSuccessful = true
                    docker container stop movie_listing-test
                    docker container rm movie_listing-test
                    '''
                }
            }
        }
    }
}