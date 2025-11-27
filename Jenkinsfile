pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                echo "Code checked out successfully"
            }
        }

        stage('Build Artifact') {
            steps {
                sh '''
                    mkdir -p build
                    echo "WordPress Custom Build" > build/README.txt
                    echo "Build Number: ${BUILD_NUMBER}" >> build/README.txt
                    echo "Built on: $(date)" >> build/README.txt
                    zip -r wordpress-build-${BUILD_NUMBER}.zip Dockerfile docker-compose.yml wp-content/ || true
                    cp wordpress-build-${BUILD_NUMBER}.zip build/
                '''
            }
        }

        stage('Archive Artifact') {
            steps {
                archiveArtifacts artifacts: 'build/*.zip', fingerprint: true
                echo "Build artifact archived successfully"
            }
        }
    }

    post {
        success {
            echo "Stage 2 - Build Stage completed successfully!"
        }
        failure {
            echo "Build failed"
        }
    }
}